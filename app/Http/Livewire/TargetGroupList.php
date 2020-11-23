<?php

namespace App\Http\Livewire;

use App\Models\TargetGroup;

class TargetGroupList extends PageComponent
{
    protected $view = 'livewire.target-group-list';

    protected $title = 'Target Groups';

    public $targetGroups;

    public function mount()
    {
        $this->targetGroups = TargetGroup::query()
            ->has('services')
            ->orderBy('name')
            ->get();
    }
}
