<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserCreate extends UserManage
{
    protected $view = 'livewire.user-create';

    protected $title = 'Register User';

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
        'user.is_admin' => [
            'boolean',
        ],
        'password' => [
            'required',
        ],
        'user.timezone' => [
            'nullable',
            'timezone',
        ],
    ];

    public function mount()
    {
        $this->authorize('create', User::class);

        $this->user = new User();
        $this->user->is_admin = false;

        parent::mount();
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

        $this->user->setEmailAsVerified($this->isEmailVerified);

        $this->user->password = Hash::make($this->password);

        $this->user->timezone = filled($this->user->timezone) ? $this->user->timezone : null;

        $this->user->save();

        session()->flash('message', 'User successfully registered.');

        return redirect()->route('users.show', $this->user);
    }
}
