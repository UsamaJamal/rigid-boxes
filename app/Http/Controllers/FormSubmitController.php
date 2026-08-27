<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\QuoteFormMail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Storage;
use App\Helpers\SpamDetector;

class FormSubmitController extends Controller
{
    private $adminEmail = 'quote@therigidbox.com';

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string'
        ]);

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'physical_address' => 'nullable|string|max:255',
            'width' => 'required|string|max:255',
            'length' => 'required|string|max:255',
            'depth' => 'required|string|max:255',
            'units' => 'required|string|max:255',
            'box_style' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'paper_coating' => 'nullable|string|max:255',
            'cad_sample' => 'nullable|string|max:255',
            'turn_around_time' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'quote_file' => 'nullable|file|max:10240', // 10MB max
            'message' => 'nullable|string'
        ]);

        if ($request->hasFile('quote_file')) {
            $path = $request->file('quote_file')->store('quotes', 'public');
            $validated['quote_file_path'] = $path;
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
