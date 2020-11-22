<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use DateTimeZone;
use Livewire\Component;

class UpdateUserProfileInformationForm extends Component
{
    public User $user;

    public string $name = '';

    public string $email = '';

    public ?string $timezone = '';

    public $timezones;

    public function mount(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->timezone = $user->timezone;
        $this->timezones = collect(DateTimeZone::listIdentifiers())
            ->mapWithKeys(fn ($tz) => [$tz => str_replace('_', ' ', $tz)]);
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

        $this->validate([
            'timezone' => [
                'nullable',
                'timezone',
            ],
        ]);
        $this->user->fill([
            'timezone' => filled($this->timezone) ? $this->timezone : null,
        ])->save();

        session()->flash('message', 'User profile information updated.');
    }

    public function detectTimezone()
    {
        $geoIp = geoip()->getLocation();
        $this->timezone = $geoIp['timezone'];
    }
}
