<?php

namespace App\Http\Livewire;

use App\Mail\SendOrganizationCreateLink;
use Illuminate\Support\Facades\Mail;

class OrganizationRequestCreateLink extends PageComponent
{
    protected $view = 'livewire.organization-request-create-link';

    protected $title = 'Register your Organization';

    public string $email = '';

    protected $rules = [
        'email' => [
            'required',
            'email',
        ],
    ];

    public function submit()
    {
        $this->validate();
        $this->validate([
            'email' => 'unique:App\Models\Organization,email',
        ]);

        Mail::to($this->email)->send(new SendOrganizationCreateLink($this->email));

        session()->flash('message', 'The e-mail has been sent.');
    }
}