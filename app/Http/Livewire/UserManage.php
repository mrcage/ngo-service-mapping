<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

abstract class UserManage extends PageComponent
{
    use AuthorizesRequests;
    use PasswordValidationRules;

    public User $user;

    public $isEmailVerified = false;

    public string $password = '';

    public bool $showPassword = false;

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
        'user.is_admin' => [
            'boolean',
        ],
        'user.timezone' => [
            'nullable',
            'timezone',
        ],
        'isEmailVerified' => [
            'boolean',
        ],
    ];

    public function mount()
    {
        $this->isEmailVerified = $this->user->hasVerifiedEmail();
    }

    public function generatePassword()
    {
        $this->showPassword = true;
        $this->password = generateStrongPassword(config('auth.password_min_length'));
    }

    public function submit()
    {
        $exists = $this->user->exists;

        $this->validate();
        $this->validate([
            'user.email' => [
                $exists
                    ? Rule::unique(User::class, 'email')->ignore($this->user)
                    : Rule::unique(User::class, 'email'),
            ],
            'password' => [
                $exists ? 'nullable' : 'required',
                $this->passwordComplexityRule(),
            ],
        ]);

        $this->user->setEmailAsVerified($this->isEmailVerified);

        if (filled($this->password)) {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->save();
    }
}
