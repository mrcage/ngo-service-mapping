<?php

namespace App\Http\Livewire;

use App\Models\User;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public User $user;

    public string $currentPassword = '';

    public string $password = '';

    public string $passwordConfirmation = '';

    public function render()
    {
        return view('livewire.update-password-form');
    }

    public function submit(UpdatesUserPasswords $action)
    {
        $action->update($this->user, [
            'current_password' => $this->currentPassword,
            'password' => $this->password,
            'password_confirmation' => $this->passwordConfirmation,
        ]);

        session()->flash('message', 'Password updated.');

        $this->reset(['currentPassword', 'password', 'passwordConfirmation']);
    }
}
