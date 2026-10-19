<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class QuoteFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $isProductRequest = strtolower(trim((string) ($this->data['source'] ?? ''))) === 'product page';
        $subject = $isProductRequest ? 'Product Request a Quote' : 'Request a Quote';

        $mail = $this->subject($subject)
                     ->view('emails.quote');
                     
        // Read the upload from the disk it was saved to. The public disk's
        // folder differs between hosts (symlinked or real public/storage),
        // so a hard-coded storage path can point at a file that isn't there.
        $path = $this->data['quote_file_path'] ?? null;
        if (!empty($path) && Storage::disk('public')->exists($path)) {
            $mail->attachFromStorageDisk('public', $path, $this->data['quote_file_name'] ?? null);
        }
        
        return $mail;
    }
}
