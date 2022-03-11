<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Files;
use App\Models\User;

class Welcome extends Component
{
    public $files;
    public $users;
    public function render()
    {
        $this->files = Files::all();
        $this->users = User::all();
        return view('livewire.welcome');
    }
}
