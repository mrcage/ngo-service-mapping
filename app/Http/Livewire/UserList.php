<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserList extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.user-list';

    protected $title = 'Users';

    public string $search = '';

    public function mount()
    {
        $this->authorize('viewAny', User::class);

        if (session()->has('users.search')) {
            $this->search = session()->pull('users.search');
        }
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
                ->get(),
        ]);
    }
}
