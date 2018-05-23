<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $mailTo;
    public $mailFrom = "file.storages.ex@gmail.com";
    public $subject;
    public $info;
    public $url;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailTo, $subject, $info, $url = null, $view)
    {
        $this->mailTo = $mailTo;
        $this->subject = $subject;
        $this->message = $info;
        $this->view = $view;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->mailTo)
            ->from($this->mailFrom)
            ->subject($this->subject)
            ->view($this->view)
            ->with(['info' => $this->info, 'url'=> $this->url]);
    }
}
