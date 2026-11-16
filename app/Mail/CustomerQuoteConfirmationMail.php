<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CustomerQuoteConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quoteData;

    public function __construct(array $quoteData)
    {
        $this->quoteData = $quoteData;
    }

    public function build()
    {
        $productName = !empty($this->quoteData['product_name']) && $this->quoteData['product_name'] !== '—' && $this->quoteData['product_name'] !== 'N/A'
            ? $this->quoteData['product_name']
            : 'Custom Rigid Boxes';

        $refCode = $this->quoteData['ref_code'] ?? ('RB-' . strtoupper(substr(uniqid(), -6)));
        $this->quoteData['ref_code'] = $refCode;

        $fromAddress = 'support@therigidboxes.com';
        $fromName = 'The Rigid Boxes';

        $mail = $this->from($fromAddress, $fromName)
            ->replyTo($fromAddress, 'The Rigid Boxes Support')
            ->subject('Thank You for Your Quote Request (' . $refCode . ') - ' . $productName . ' | The Rigid Boxes')
            ->view('emails.customer_quote_confirmation');

        $path = $this->quoteData['quote_file_path'] ?? null;
        if (!empty($path) && Storage::disk('public')->exists($path)) {
            $mail->attachFromStorageDisk('public', $path, $this->quoteData['quote_file_name'] ?? null);
        }

        return $mail;
    }
}
