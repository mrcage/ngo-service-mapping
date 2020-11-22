<?php

namespace App\Http\Livewire;

use App\Models\User;

class UserCreate extends UserManage
{
    protected $view = 'livewire.user-create';

    protected $title = 'Register User';

    public function mount()
    {
        $this->authorize('create', User::class);

        $this->user = new User();

        parent::mount();
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'User successfully registered.');

        return redirect()->route('users.show', $this->user);
    }
}
