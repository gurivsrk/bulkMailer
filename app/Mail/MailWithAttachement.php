<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Address;

class MailWithAttachement extends Mailable
{
    use Queueable, SerializesModels;

    public $name,$title,$msg,$toMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$title,$msg)
    {
        $this->name = $name;
        $this->title = $title;
        $this->msg = $msg;
        $this->toMail = 'test@test.com';

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new address('sendmail5525@gmail.com', 'Test Sender'),
            subject: $this->title,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'newsletter.custom',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        if(file_exists(base_path("storage/app/public/".date('M')."/$this->name.pdf"))){
            return [
                Attachment::fromPath(base_path("storage/app/public/".date('M')."/$this->name.pdf"))
                    ->as("$this->name.pdf")
                    ->withMime('application/pdf'),
            ];
        }
        else{
            return [ ];
        }
    }
}
