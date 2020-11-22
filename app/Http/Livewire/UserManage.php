<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class UserManage extends PageComponent
{
    use AuthorizesRequests;
    use PasswordValidationRules;

    public User $user;

    public $isEmailVerified = false;

    public string $password = '';

    public bool $showPassword = false;

    public function mount()
    {

    }

    public function generatePassword()
    {
        $this->showPassword = true;
        $this->password = generateStrongPassword(config('auth.password_min_length'));
    }
}
