<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\Organization;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceDelete extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.service-delete';

    protected function title()
    {
        return $this->service->name . ' | Delete Service';
    }

    public Service $service;

    public Location $location;

    public Organization $organization;

    public string $cancelUrl;

    public function mount()
    {
        $this->authorize('delete', $this->service);

        if (isset($this->location)) {
            $this->cancelUrl = route('locations.show', $this->location);
        } else if (isset($this->organization)) {
            $this->cancelUrl = route('organizations.show', $this->organization);
        }
    }

    public function submit()
    {
        $this->service->delete();

        session()->flash('message', 'Service successfully deleted.');

        if (isset($this->location)) {
            return redirect()->route('locations.show', $this->location);
        } else if (isset($this->organization)) {
            return redirect()->route('organizations.show', $this->organization);
        }
    }
}
