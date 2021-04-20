<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyEmail extends Mailable
{
    public $data;
    use Queueable, SerializesModels;
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

        return $this->from('engineerlife021@gmail.com')->subject($this->data['subject'])->view('admin.view_mail')->with('data', $this->data);
        // return $this->from('tasali@tasali.media')->subject($this->data['subject'])->view($this->data['template'])->with('data', $this->data);
    }


}