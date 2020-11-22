<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserDetail extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.user-detail';

    protected function title()
    {
        return $this->user->name . ' | User';
    }

    public User $user;

    public array $ipData = [];

    public function mount()
    {
        $this->authorize('view', $this->user);
    }

    public function fetchIpData()
    {
        $ip = $this->user->last_login_ip;
        $this->ipData['Hostname'] = gethostbyaddr($ip);
        $geoIp = geoip()->getLocation($ip);
        collect($geoIp->toArray())
            ->except('ip', 'default', 'cached')
            ->filter()
            ->each(function ($item, $key) {
                $this->ipData[$key] = $item;
            });
    }
}
