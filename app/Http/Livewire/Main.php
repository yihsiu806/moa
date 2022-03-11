<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->$slug = $slug;
    }

    public function render()
    {
        return view('livewire.main');
    }
}
