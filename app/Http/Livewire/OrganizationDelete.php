<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationDelete extends Component
{
    use AuthorizesRequests;

    public Organization $organization;

    public function render()
    {
        $this->authorize('delete', $this->organization);

        return view('livewire.organization-delete')
            ->layout(null, [
                'title' => $this->organization->name . ' | Delete Organization',
            ]);
    }

    public function submit()
    {
        $this->authorize('delete', $this->organization);

        $this->organization->delete();

        session()->flash('message', 'Organization successfully deleted.');

        return redirect()->route('organizations.index');
    }
}
