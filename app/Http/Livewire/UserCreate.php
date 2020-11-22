<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use DateTimeZone;
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

    public $isEmailVerified = false;

    public string $password = '';

    public $timezones;

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

        $this->timezones = collect(DateTimeZone::listIdentifiers())
            ->mapWithKeys(fn ($tz) => [$tz => str_replace('_', ' ', $tz)]);
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

    public function generatePassword()
    {
        $this->showPassword = true;
        $this->password = generateStrongPassword(config('auth.password_min_length'));
    }
}
