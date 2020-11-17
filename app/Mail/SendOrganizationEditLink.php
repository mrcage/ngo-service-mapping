<?php

namespace App\Mail;

use App\Models\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SendOrganizationEditLink extends Mailable
{
    use Queueable, SerializesModels;

    private int $validityInMinutes = 30;

    public Organization $organization;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Permission to edit your organization profile')
            ->markdown('emails.organization-edit-link', [
                'url' => URL::temporarySignedRoute('organizations.editExternal', now()->addMinutes($this->validityInMinutes), $this->organization),
                'validityInMinutes' => $this->validityInMinutes,
            ]);
    }
}
