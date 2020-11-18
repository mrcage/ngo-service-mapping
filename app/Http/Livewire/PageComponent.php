<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class PageComponent extends Component
{
    protected $view;

    protected $title = null;

    public function render()
    {
        return $this->getView();
    }

    protected function getView($args = [])
    {
        return view($this->view, $args)
            ->layout(null, [
                'title' => method_exists($this, 'title') ? $this->title() : $this->title,
            ]);
    }
}
