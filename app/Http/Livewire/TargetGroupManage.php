<?php

namespace App\Http\Livewire;

use App\Models\TargetGroup;

class TargetGroupManage extends NameTypeForm
{
    protected $view = 'livewire.target-group-manage';

    protected $title = 'Manage Target Groups';

    protected $modelClass = TargetGroup::class;
}
