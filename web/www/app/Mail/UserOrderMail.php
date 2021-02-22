<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param $data
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

        $pos_url = route(config('app.backend_home', 'pos').'.login');
        $subject = config('app.name').' Food Order';
        $from_address = $this->data->shippingDetails ? $this->data->shippingDetails->email : config('mail.from.address');
        return $this->from($from_address)
            ->subject($subject)
            ->markdown('emails.user_order')
            ->with(['order' => $this->data, 'pos_url' => $pos_url]);
    }
}
