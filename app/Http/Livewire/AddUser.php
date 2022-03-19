<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Division;

class AddUser extends Component
{
    public $divisions;

    public function render()
    {
        $this->divisions = Division::select('id', 'name')->get();

        return view('livewire.add-user');
    }
}
