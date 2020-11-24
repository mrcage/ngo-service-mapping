<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Sector;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

abstract class OrganizationManage extends PageComponent
{
    public Organization $organization;

    public string $cancelUrl;

    public bool $disableEmail = false;

    public Collection $types;

    protected $rules = [
        'organization.name' => [
            'filled',
            'string',
            'min:3',
            'max:255',
        ],
        'organization.abbreviation' => [
            'nullable',
            'string',
            'max:5',
        ],
        'organization.type_id' => [
            'required',
            'exists:organization_types,id',
        ],
        'organization.description' => [
            'nullable',
            'min:3',
        ],
        'organization.email' => [
            'nullable',
            'email',
        ],
        'organization.phone' => [
            'nullable',
            // TODO proper regex
        ],
        'organization.website' => [
            'nullable',
            'url',
            'max:255',
        ],
        'organization.facebook' => [
            'nullable',
            'url',
            'max:255',
        ],
        'organization.instagram' => [
            'nullable',
            'url',
            'max:255',
        ],
        'organization.twitter' => [
            'nullable',
            'url',
            'max:255',
        ],
        'organization.youtube' => [
            'nullable',
            'url',
            'max:255',
        ],
        'organization.linkedin' => [
            'nullable',
            'url',
            'max:255',
        ],
    ];

    protected $validationAttributes = [
        'organization.type_id' => 'type'
    ];

    public function mount()
    {
        $this->types = OrganizationType::orderBy('name')->get();
    }

    public function submit()
    {
        $this->validate();

        if ($this->organization->exists) {
            $this->validate([
                'organization.name' => Rule::unique(Organization::class, 'name')
                    ->ignore($this->organization->id),
                'organization.email' => Rule::unique(Organization::class, 'email')
                    ->ignore($this->organization->id),
            ]);
        } else {
            $this->validate([
                'organization.name' => Rule::unique(Organization::class, 'name'),
                'organization.email' => Rule::unique(Organization::class, 'email'),
            ]);
        }

        $this->organization->save();
    }
}
