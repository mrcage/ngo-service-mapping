<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserCreate extends PageComponent
{
    use AuthorizesRequests;
    use PasswordValidationRules;

    protected $view = 'livewire.user-create';

    protected $title = 'Register User';

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
            'nullable',
            'boolean',
        ],
        'password' => [
            'required',
        ]
    ];

    public function mount()
    {
        $this->authorize('create', User::class);

        $this->user = new User();
    }

    public function submit()
    {
        $this->validate();
        $this->validate([
            'user.email' => [
                Rule::unique(User::class, 'email'),
            ],
            'password' => [
                $this->passwordComplexityRule(),
            ],
        ]);

        $this->user->isEmailVerified = $this->isEmailVerified;
        $this->user->password = Hash::make($this->password);

        $this->user->save();

        session()->flash('message', 'User successfully registered.');

        return redirect()->route('users.show', $this->user);
    }
}
