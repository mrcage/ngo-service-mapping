<?php

namespace App\Http\Livewire;

use App\Mail\SendOrganizationEditLink;
use App\Models\Organization;
use Illuminate\Support\Facades\Mail;

class OrganizationRequestEditLink extends PageComponent
{
    protected $view = 'livewire.organization-request-edit-link';

    protected function title()
    {
        return $this->organization->name . ' | Edit your Organization';
    }

    public Organization $organization;

    public function submit()
    {
        Mail::to($this->organization->email)->send(new SendOrganizationEditLink($this->organization));

        session()->flash('message', 'The e-mail has been sent.');
    }
}
