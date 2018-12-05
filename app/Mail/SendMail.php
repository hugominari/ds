<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
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
	    $data = $this->data;

	    return $this->from($data->sender_mail, $data->sender_name)
		    ->subject($data->subject)
		    ->view("emails.{$data->template}")
		    ->text("emails.plain.{$data->template}")
		    ->with($data->params);
    }
}
