<?php

namespace App\Http\Livewire;

use App\Models\Sector;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class SectorManage extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.sector-manage';

    protected $title = 'Manage Sectors';

    public Collection $items;

    public ?Sector $selectedItem = null;

    protected $rules = [
        'selectedItem.name' => [
            'required',
            'string',
            'min:3',
        ],
    ];

    public function mount()
    {
        $this->authorize('create', Sector::class);

        $this->items = Sector::query()
            ->orderBy('name')
            ->get();
    }

    public function newItem()
    {
        $this->selectedItem = new Sector();
    }

    public function editItem(Sector $item)
    {
        $this->selectedItem = $item;
    }

    public function cancelEdit()
    {
        $this->selectedItem = null;
    }

    public function submit()
    {
        if ($this->selectedItem !== null) {
            if ($this->selectedItem->exists) {
                $this->authorize('update', $this->selectedItem);
            } else {
                $this->authorize('create', Sector::class);
            }

            $this->validate();
            if ($this->selectedItem->exists) {
                $this->validate([
                    'selectedItem.name' => Rule::unique(Sector::class, 'name')
                        ->ignore($this->selectedItem->id),
                ]);
            } else {
                $this->validate([
                    'selectedItem.name' => 'unique:App\Models\Sector,name',
                ]);
            }

            $this->selectedItem->save();

            if (($key = $this->items->search(fn ($s) => $s->id === $this->selectedItem->id)) !== false) {
                $this->items[$key] = $this->selectedItem;
            } else {
                $this->items[] = $this->selectedItem;
            }

            $this->selectedItem = null;
        }
    }

    public function deleteItem(Sector $item)
    {
        $this->authorize('delete', $item);

        $item->delete();

        if (($key = $this->items->search(fn ($s) => $s->id === $item->id)) !== false) {
            $this->items->forget($key);
        }
    }
}
