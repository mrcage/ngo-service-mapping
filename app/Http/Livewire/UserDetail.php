<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserDetail extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.user-detail';

    protected function title()
    {
        return $this->user->name . ' | User';
    }

    public User $user;

    public function mount()
    {
        $this->authorize('view', $this->user);
    }
}
