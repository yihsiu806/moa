<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Files;

class Myupload extends Component
{
    public $files;
    public function render()
    {
        $this->files = Files::all();
        return view('livewire.myupload');
    }
}
