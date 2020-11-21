<?php

namespace App\Http\Livewire;

use App\Models\Sector;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class SectorManage extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.sector-manage';

    protected $title = 'Manage Sectors';

    public Collection $sectors;

    public array $newSectors;

    public array $newItem = [];

    public array $deletedIndexes = [];

    protected $rules = [
        'sectors.*.name' => [
            'required',
            'string',
            'min:3',
        ],
        // 'newItem.name' => 'string|min:6',
    ];

    public function mount()
    {
        $this->authorize('create', Sector::class);

        $this->sectors = Sector::query()
            ->orderBy('name')
            ->get();

        $this->newSectors = [];
    }

    public function submit()
    {
        $this->validate();

        foreach ($this->deletedIndexes as $index) {
            $this->sectors->get($index)->delete();
            $this->sectors->forget($index);
        }

        foreach ($this->sectors as $sector) {
            $sector->save();
        }

        foreach ($this->newSectors as $data) {
            $sector = new Sector();
            $sector->fill($data);
            $sector->save();
        }

        session()->flash('message', 'Sectors successfully updated.');

        return redirect()->route('sectors.index');
    }

    public function deleteItem($index)
    {
        if (($key = array_search($index, $this->deletedIndexes)) !== false) {
            unset($this->deletedIndexes[$key]);
        } else {
            $this->deletedIndexes[] = $index;
        }
    }

    public function addItem()
    {
        $validatedData = Validator::make(
            $this->newItem,
            [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                ]
            ],
        )->validate();
        $this->newSectors[] = $validatedData;
        $this->reset('newItem');
    }
}
