<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
                     
        if (!empty($this->data['quote_file_path'])) {
            $mail->attach(storage_path('app/public/' . $this->data['quote_file_path']));
        }
        
        return $mail;
    }
}
