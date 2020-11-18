<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationCreate extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-create';

    protected $title = 'Register Organization';

    public Organization $organization;

    protected $rules = [
        'organization.name' => [
            'filled',
            'string',
            'min:3',
            'max:255',
            'unique:App\Models\Organization,name',
        ],
        'organization.description' => [
            'nullable',
        ],
        'organization.email' => [
            'nullable',
            'email',
            'unique:App\Models\Organization,email',
        ],
    ];

    public function mount()
    {
        $this->authorize('create', Organization::class);

        $this->organization = new Organization();
    }

    public function submit()
    {
        $this->validate();

        $this->organization->save();

        session()->flash('message', 'Organization successfully registered.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
