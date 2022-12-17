<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $template;

    /**
     * Create a new message instance.
     * expecting data to have template
     *  $data = [
     *   'template' => $template
     *  ];
     * @return void
     */
    public function __construct(Array $data = null)
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

        // if not template is provided use this view template
        if(!$this->data['template']){
            return $this->subject('Demo mail')->view('emails.demo-mail');
        }
        // if template is provided then we can send html provided in the template
        return $this->html($this->data['template'])->subject('Demo mail');
    }

}
