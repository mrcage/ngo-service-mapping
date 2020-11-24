<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceCreate extends ServiceManage
{
    use AuthorizesRequests;

    protected $view = 'livewire.service-create';

    protected $title = 'Register Service';

    public function mount()
    {
        $this->authorize('create', Service::class);

        $this->service = new Service();

        parent::mount();
    }

    public function submit()
    {
        if (isset($this->location)) {
            $this->service->location()->associate($this->location);
        } else if (isset($this->organization)) {
            $this->service->organization()->associate($this->organization);
        }

        parent::submit();

        session()->flash('message', 'Service successfully registered.');

        if (isset($this->location)) {
            return redirect()->route('locations.show', $this->location);
        } else if (isset($this->organization)) {
            return redirect()->route('organizations.show', $this->organization);
        }
    }
}
