<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserDelete extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.user-delete';

    protected function title()
    {
        return $this->user->name . ' | Delete User';
    }

    public User $user;

    public function mount()
    {
        $this->authorize('delete', $this->user);
    }

    public function submit()
    {
        $this->user->delete();

        session()->flash('message', 'User successfully deleted.');

        return redirect()->route('users.index');
    }
}
