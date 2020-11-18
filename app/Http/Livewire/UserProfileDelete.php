<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileDelete extends PageComponent
{
    protected $view = 'livewire.user-profile-delete';

    protected $title = 'Delete user account';

    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function submit()
    {
        $this->user->delete();

        session()->flash('message', 'Your user account has been deleted.');
    }
}
