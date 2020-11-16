<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\Component;

class OrganizationList extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.organization-list', [
            'organizations' => Organization::query()
                ->when(filled($this->search), fn ($q) => $q->where('name', 'like', '%' . trim($this->search) . '%'))
                ->orderBy('name')
                ->get(),
        ])->layout(null, [
            'title' => 'Organizations',
        ]);
    }
}
