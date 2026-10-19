<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactFormMail;
use App\Mail\QuoteFormMail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Storage;
use App\Helpers\SpamDetector;
use App\Support\HumanCheck;
use Illuminate\Validation\ValidationException;

class FormSubmitController extends Controller
{
    private $adminEmail = 'quote@therigidboxes.com';

    // Letters (any language), spaces, apostrophes, hyphens and dots.
    private const NAME_RULE = 'regex:/^[\pL\s\'\-.]+$/u';
    // Digits and common phone symbols, with at least one digit.
    private const PHONE_RULE = 'regex:/^(?=.*\d)[0-9+\-\s()]+$/';

    // TrimStrings + ConvertEmptyStringsToNull run before validation, so a
    // value made only of spaces arrives as null and fails "required".
    private function contactMessages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Name can contain letters only.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'human_token.required' => 'Please refresh the page and try again.',
            'human_answer.required' => 'Please solve the "Are you a human?" check.',
            'human_answer.integer' => 'Please solve the "Are you a human?" check.',
        ];
    }

    private const HUMAN_CHECK_RULES = [
        'human_token' => 'required|string',
        'human_answer' => 'required|integer',
    ];

    // Runs after every other rule has passed, so a typo elsewhere does not
    // burn the question. The token is single-use from here on.
    private function confirmHuman(Request $request, array &$validated): void
    {
        if (!HumanCheck::passes($request->input('human_token'), $request->input('human_answer'), true)) {
            throw ValidationException::withMessages([
                'human_answer' => 'Please solve the new "Are you a human?" question and try again.',
            ]);
        }
        unset($validated['human_token'], $validated['human_answer']);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', self::NAME_RULE],
            'product_name' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', 'max:20', self::PHONE_RULE],
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string'
        ] + self::HUMAN_CHECK_RULES, $this->contactMessages());
        $this->confirmHuman($request, $validated);

        $validated['product_name'] = $validated['product_name'] ?? null;
        $validated['source'] = 'Contact Us';
        if (empty($validated['product_name'])) {
            $refererPath = parse_url((string) $request->headers->get('referer'), PHP_URL_PATH);
            $slug = trim((string) basename(rtrim($refererPath ?: '', '/')));
            if ($slug) {
                $validated['product_name'] = DB::table('admin_products')->where('slug', $slug)->value('title');
            }
        }
        $isSpam = SpamDetector::isSpam($validated['message'] ?? '', $validated['subject'] ?? '', $validated['email'] ?? '');

        if (!$isSpam) {
            Mail::to($this->adminEmail)->send(new ContactFormMail($validated));
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Thank you for contacting us! Your message has been sent successfully.']);
        }
        return back()->with('success', 'Thank you for contacting us! Your message has been sent successfully.');
    }

    public function submitQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', self::NAME_RULE],
            'product_name' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', 'max:20', self::PHONE_RULE],
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            // Only the Request-a-Quote page and the product sample-kit form
            // show this field; when a form sends it, it must be filled in.
            'physical_address' => 'sometimes|required|string|max:255',
            'width' => 'required|string|max:255',
            'length' => 'required|string|max:255',
            'depth' => 'required|string|max:255',
            'units' => 'required|string|max:255',
            // Every quote form shows a Box Style picker except the top product
            // page form, where the product itself is the box style.
            'box_style' => 'sometimes|required|string|max:255',
            'material' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'paper_coating' => 'nullable|string|max:255',
            'cad_sample' => 'nullable|in:Yes,No',
            'turn_around_time' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'quote_file' => 'nullable|file|max:10240', // 10MB max
            'message' => 'nullable|string'
        ] + self::HUMAN_CHECK_RULES, $this->contactMessages() + [
            'physical_address.required' => 'Please enter your physical address.',
            'width.required' => 'Please enter the box width.',
            'length.required' => 'Please enter the box length.',
            'depth.required' => 'Please enter the box depth.',
            'units.required' => 'Please select the units.',
            'box_style.required' => 'Please select a Box Style.',
            'quantity.required' => 'Please enter the quantity.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'Quantity must be at least 1.',
        ]);
        $this->confirmHuman($request, $validated);

        // Optional preferences: an empty choice is recorded explicitly.
        foreach (['material', 'color', 'paper_coating'] as $field) {
            $validated[$field] = $validated[$field] ?? 'Not sure';
        }
        $validated['cad_sample'] = $validated['cad_sample'] ?? 'No';

        $validated['source'] = $validated['source'] ?? 'N/A';
        $isProductPageQuote = strtolower(trim((string) $validated['source'])) === 'product page';

        // Product pages already provide their own product name. On every
        // other quote form, the selected box style is the requested product.
        $validated['product_name'] = $isProductPageQuote
            ? ($validated['product_name'] ?? 'N/A')
            : (!empty(trim((string) ($validated['box_style'] ?? '')))
                ? trim($validated['box_style'])
                : ($validated['product_name'] ?? 'N/A'));

        if ($request->hasFile('quote_file')) {
            $path = $request->file('quote_file')->store('quotes', 'public');
            $validated['quote_file_path'] = $path;
            $validated['quote_file_name'] = $request->file('quote_file')->getClientOriginalName();
        }

        $isSpam = SpamDetector::isSpam($validated['message'] ?? '', $validated['subject'] ?? 'Quote Request', $validated['email'] ?? '');

        if (!$isSpam) {
            Mail::to($this->adminEmail)->send(new QuoteFormMail($validated));
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Thank you! Your request for a quote has been submitted successfully.']);
        }
        return back()->with('success', 'Thank you! Your request for a quote has been submitted successfully.');
    }

    public function submitNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255'
        ]);

        Mail::to($this->adminEmail)->send(new NewsletterMail($validated['email']));

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Thank you for subscribing to our newsletter!']);
        }
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
