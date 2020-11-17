<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Livewire\Component;

class UpdateUserProfileInformationForm extends Component
{
    public User $user;

    public string $name = '';

    public string $email = '';

    public function mount(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.update-user-profile-information-form');
    }

    public function submit(UpdateUserProfileInformation $action)
    {
        $action->update($this->user, [
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'User profile information updated.');
    }
}
