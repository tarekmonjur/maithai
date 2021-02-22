<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerContact extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @return void
     */
    public function __construct(array $data)
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
        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader('Content-Type', 'text/html');

            $type = $message->getHeaders()->get('Content-Type');
            $type->setValue('text/html');
            $message->setCharset('UTF-8');
            $message->setEncoder(
                new \Swift_Mime_ContentEncoder_PlainContentEncoder('8bit')
            );
        });

        return $this->from($this->data['email'])
            ->subject('New Customer Contact Message')
            ->markdown('emails.customer_contact', $this->data);
    }
}
