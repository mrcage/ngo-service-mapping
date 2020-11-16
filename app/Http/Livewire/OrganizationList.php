<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\Component;

class OrganizationList extends Component
{
    public string $search = '';

    public function mount()
    {
        if (session()->has('organizations.search')) {
            $this->search = session()->pull('organizations.search');
        }
    }

    public function render()
    {
        if (filled($this->search)) {
            session()->put('organizations.search', $this->search);
        } else {
            session()->forget('organizations.search');
        }

        return view('livewire.organization-list', [
            'organizations' => Organization::query()
                ->when(filled($this->search), fn ($q) => $q->filter($this->search))
                ->orderBy('name')
                ->get(),
        ])->layout(null, [
            'title' => 'Organizations',
        ]);
    }
}
