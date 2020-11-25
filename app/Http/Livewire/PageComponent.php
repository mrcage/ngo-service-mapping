<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class PageComponent extends Component
{
    protected $view;

    protected $title = null;

    protected $wideLayout = false;

    public function render()
    {
        return $this->getView();
    }

    protected function getView($args = [])
    {
        return view($this->view, $args)
            ->extends('layouts.app', [
                'title' => method_exists($this, 'title') ? $this->title() : $this->title,
                'wideLayout' => $this->wideLayout,
            ]);
    }
}
