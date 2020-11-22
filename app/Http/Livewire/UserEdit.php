<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserEdit extends PageComponent
{
    use AuthorizesRequests;
    use PasswordValidationRules;

    protected $view = 'livewire.user-edit';

    protected function title()
    {
        return $this->user->name . ' | Edit User';
    }

    public User $user;

    public $isEmailVerified;

    public string $password = '';

    protected $rules = [
        'user.name' => [
            'required',
            'string',
            'max:255'
        ],
        'user.email' => [
            'required',
            'string',
            'email',
            'max:255',
        ],
        'isEmailVerified' => [
            'boolean',
        ],
        'password' => [
            'nullable',
        ]
    ];

    public function mount()
    {
        $this->authorize('update', $this->user);

        $this->isEmailVerified = $this->user->isEmailVerified;
    }

    public function submit()
    {
        $this->validate();
        $this->validate([
            'user.email' => [
                Rule::unique(User::class, 'email')
                    ->ignore($this->user->id),
            ]
        ]);

        $this->user->isEmailVerified = $this->isEmailVerified;

        $message = 'User successfully updated.';
        if ($this->updatePassword()) {
            $message .= ' The password has been changed.';
        }

        $this->user->save();

        session()->flash('message', $message);

        return redirect()->route('users.show', $this->user);
    }

    private function updatePassword()
    {
        if (filled($this->password)) {
            $this->validate([
                'password' => [
                    $this->passwordComplexityRule(),
                ]
            ]);
            $this->user->password = Hash::make($this->password);
            return true;
        }
        return false;
    }
}
