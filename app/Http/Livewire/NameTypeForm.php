<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

abstract class NameTypeForm extends PageComponent
{
    use AuthorizesRequests;

    protected $modelClass;

    public Collection $items;

    public $selectedItem = null;

    public $deletionItem = null;

    protected $rules = [
        'selectedItem.name' => [
            'required',
            'string',
            'min:3',
        ],
    ];

    public function mount()
    {
        $this->authorize('create', $this->modelClass);

        $this->items = $this->modelClass::query()
            ->orderBy('name')
            ->get();
    }

    public function getAllowCreateProperty()
    {
        return Auth::user()->can('create', $this->modelClass);
    }

    public function newItem()
    {
        $this->selectedItem = new $this->modelClass();

        $this->emit('editorReady');
    }

    public function editItem($slug)
    {
        $item = $this->modelClass::whereSlug($slug)->firstOrFail();

        $this->selectedItem = $item;

        $this->emit('editorReady');
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
                $this->authorize('create', $this->modelClass);
            }

            $this->validate();
            if ($this->selectedItem->exists) {
                $this->validate([
                    'selectedItem.name' => Rule::unique($this->modelClass, 'name')
                        ->ignore($this->selectedItem->id),
                ]);
            } else {
                $this->validate([
                    'selectedItem.name' => Rule::unique($this->modelClass, 'name'),
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

    public function confirmDeleteItem($slug)
    {
        $item = $this->modelClass::whereSlug($slug)->firstOrFail();

        $this->deletionItem = $item;
    }

    public function cancelDelete()
    {
        $this->deletionItem = null;
    }

    public function deleteItem()
    {
        if ($this->deletionItem !== null) {
            $this->authorize('delete', $this->deletionItem);

            $id = $this->deletionItem->id;
            $this->deletionItem->delete();

            if (($key = $this->items->search(fn ($s) => $s->id === $id)) !== false) {
                $this->items->forget($key);
            }

            $this->deletionItem = null;
        }
    }
}
