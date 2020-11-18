<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Illuminate\Validation\Rule;

class OrganizationEditExternal extends PageComponent
{
    protected $view = 'livewire.organization-edit-external';

    protected function title()
    {
        return $this->organization->name . ' | Edit your Organization';
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
