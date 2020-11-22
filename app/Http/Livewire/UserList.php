<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class UserList extends PageComponent
{
    use AuthorizesRequests;
    use WithPagination;

    protected $view = 'livewire.user-list';

    protected $title = 'Users';

    public string $search = '';

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->authorize('viewAny', User::class);

        if (session()->has('users.search')) {
            $this->search = session()->pull('users.search');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (filled($this->search)) {
            session()->put('users.search', $this->search);
        } else {
            session()->forget('users.search');
        }

        return $this->getView([
            'users' => User::query()
                ->when(filled($this->search), fn ($q) => $q->filter($this->search))
                ->orderBy('name')
                ->paginate(10),
        ]);
    }
}
