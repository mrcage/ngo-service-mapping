<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileDelete extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.user-profile-delete')
            ->layout(null, [
                'title' => 'Delete user account',
            ]);
    }

    public function submit()
    {
        $this->user->delete();

        session()->flash('message', 'Your user account has been deleted.');
    }
}
