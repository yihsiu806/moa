<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Files extends Component
{
    public $slug;

    public function mount($slug = 'welcome')
    {
        $this->$slug = $slug;
    }

    public function render()
    {
        return view('livewire.files');
    }
}
