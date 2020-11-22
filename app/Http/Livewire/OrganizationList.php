<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\WithPagination;

class OrganizationList extends PageComponent
{
    use WithPagination;

    protected $view = 'livewire.organization-list';

    protected $title = 'Organizations';

    public string $search = '';

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        if (session()->has('organizations.search')) {
            $this->search = session()->pull('organizations.search');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (filled($this->search)) {
            session()->put('organizations.search', $this->search);
        } else {
            session()->forget('organizations.search');
        }

        return $this->getView([
            'organizations' => Organization::query()
                ->when(filled($this->search), fn ($q) => $q->filter($this->search))
                ->orderBy('name')
                ->paginate(25),
        ]);
    }
}
