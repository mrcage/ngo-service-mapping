<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfile extends PageComponent
{
    protected $view = 'livewire.user-profile';

    protected $title = 'User profile';

    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
    }
}
