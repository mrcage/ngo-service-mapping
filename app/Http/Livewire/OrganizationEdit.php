<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationEdit extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-edit';

    protected function title()
    {
        return $this->organization->name . ' | Edit Organization';
    }

    public Organization $organization;

    protected $rules = [
        'organization.name' => [
            'filled',
            'string',
            'min:3',
            'max:255',
        ],
        'organization.description' => [
            'nullable',
            'min:3',
        ],
        'organization.email' => [
            'nullable',
            'email',
        ]
    ];

    public function mount()
    {
        $this->authorize('update', $this->organization);
    }

    public function submit()
    {
        $this->validate();
        $this->validate([
            'organization.name' => Rule::unique(Organization::class, 'name')
                ->ignore($this->organization->id),
            'organization.email' => Rule::unique(Organization::class, 'email')
                ->ignore($this->organization->id),
        ]);

        $this->organization->save();

        session()->flash('message', 'Organization successfully updated.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
