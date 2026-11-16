<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $refCode = $this->data['ref_code'] ?? ('RB-' . strtoupper(substr(uniqid(), -6)));
        $this->data['ref_code'] = $refCode;

        $fromAddress = 'support@therigidboxes.com';
        $fromName = 'The Rigid Boxes';

        return $this->from($fromAddress, $fromName)
            ->replyTo($fromAddress, 'The Rigid Boxes Support')
            ->subject('Thank You for Contacting The Rigid Boxes (' . $refCode . ')')
            ->view('emails.customer_contact_confirmation');
    }
}
