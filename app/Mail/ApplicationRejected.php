<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationRejected extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;
    public $messageText;

    public function __construct(Application $application, $message = null)
    {
        $this->application = $application;
        $this->messageText = $message;
    }

    public function build()
    {
        return $this->subject('Application Update from Company')
                    ->view('emails.application_rejected')
                    ->with([
                        'application' => $this->application,
                        'messageText' => $this->messageText,
                    ]);
    }
}
