<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class OrganizationEdit extends Component
{
    use AuthorizesRequests;

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

    public function render()
    {
        $this->authorize('update', $this->organization);

        return view('livewire.organization-edit')
            ->layout(null, [
                'title' => $this->organization->name . ' | Edit Organization',
            ]);
    }

    public function submit()
    {
        $this->authorize('update', $this->organization);

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
