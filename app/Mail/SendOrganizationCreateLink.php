<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SendOrganizationCreateLink extends Mailable
{
    use Queueable, SerializesModels;

    private int $validityInMinutes = 30;

    public string $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Permission to register your organization profile')
            ->markdown('emails.organization-create-link', [
                'url' => URL::temporarySignedRoute('organizations.createExternal', now()->addMinutes($this->validityInMinutes), $this->email),
                'validityInMinutes' => $this->validityInMinutes,
            ]);
    }
}
