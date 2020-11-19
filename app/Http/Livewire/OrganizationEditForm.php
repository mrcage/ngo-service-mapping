<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Sector;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class OrganizationEditForm extends Component
{
    public Organization $organization;

    public string $cancelUrl;

    public array $checkedSectors;

    public bool $disableEmail = false;

    public Collection $sectors;

    public Collection $types;

    protected $rules = [
        'organization.name' => [
            'filled',
            'string',
            'min:3',
            'max:255',
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
        'organization.website' => [
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
        $this->checkedSectors = $this->organization->sectors->pluck('slug')->toArray();
        $this->sectors = Sector::orderBy('name')->get();
        $this->types = OrganizationType::orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.organization-edit-form');
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
                'organization.name' => 'unique:App\Models\Organization,name',
                'organization.email' => 'unique:App\Models\Organization,email',
            ]);
        }

        $this->emit('formSubmitted', $this->organization, $this->checkedSectors);
    }
}
