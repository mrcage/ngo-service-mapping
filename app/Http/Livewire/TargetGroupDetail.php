<?php

namespace App\Http\Livewire;

use App\Models\TargetGroup;

class TargetGroupDetail extends PageComponent
{
    protected $view = 'livewire.target-group-detail';

    protected function title()
    {
        return $this->targetGroup->name . ' | Target Group';
    }

    public TargetGroup $targetGroup;
}
