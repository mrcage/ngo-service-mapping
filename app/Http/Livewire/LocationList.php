<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\WithPagination;

class LocationList extends PageComponent
{
    use WithPagination;

    protected $view = 'livewire.location-list';

    protected $title = 'Locations';

    public string $search = '';

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        if (session()->has('locations.search')) {
            $this->search = session()->pull('locations.search');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (filled($this->search)) {
            session()->put('locations.search', $this->search);
        } else {
            session()->forget('locations.search');
        }

        return $this->getView([
            'locations' => Location::query()
                ->when(filled($this->search), fn ($q) => $q->filter($this->search))
                ->orderBy('name')
                ->paginate(25),
        ]);
    }
}
