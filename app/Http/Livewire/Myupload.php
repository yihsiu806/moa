<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Files;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\Officer;

class Myupload extends Component
{
    public $division;
    public $officer;
    public $files;

    public function render()
    {
        $user = Auth::user();

        $this->division = Division::find($user->division);
        $this->officer = Officer::where('division', $user->division)->first();
        $this->files = Files::all();
        return view('livewire.myupload');
    }
}
