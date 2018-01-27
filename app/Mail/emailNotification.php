<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class emailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $content;
    public $subject_name;
    public $grade;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$content,$subject_name,$grade)
    {
        $this->title = $title;
        $this->content = $content;
        $this->subject_name = $subject_name;
        $this->grade = $grade;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Laravelos@noreply')->view('emails.send')->with(['title' => $this->title, 'content' => $this->content, 'subject' => $this->subject_name, 'grade' => $this->grade]);
    }
}
