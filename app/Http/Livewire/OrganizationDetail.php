<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\Component;

class OrganizationDetail extends Component
{
    public Organization $organization;

    public function render()
    {
        return view('livewire.organization-detail')
            ->layout(null, [
                'title' => $this->organization->name . ' | Organization',
            ]);
    }
}
