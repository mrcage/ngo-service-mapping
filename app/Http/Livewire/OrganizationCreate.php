<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationCreate extends Component
{
    use AuthorizesRequests;

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
        $this->organization = new Organization();
    }

    public function render()
    {
        $this->authorize('create', Organization::class);

        return view('livewire.organization-create')
            ->layout(null, [
                'title' => 'Register Organization',
            ]);
    }

    public function submit()
    {
        $this->authorize('create', Organization::class);

        $this->validate();

        $this->organization->save();

        session()->flash('message', 'Organization successfully registered.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
