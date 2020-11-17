<?php

namespace App\Http\Livewire;

use App\Mail\SendOrganizationEditLink;
use App\Models\Organization;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrganizationRequestEditLink extends Component
{
    public Organization $organization;

    public function render()
    {
        return view('livewire.organization-request-edit-link')
            ->layout(null, [
                'title' => $this->organization->name . ' | Edit your Organization',
            ]);
    }

    public function submit()
    {
        Mail::to($this->organization->email)->send(new SendOrganizationEditLink($this->organization));

        session()->flash('message', 'The e-mail has been sent.');
    }
}
