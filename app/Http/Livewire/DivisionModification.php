<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\Officer;

class DivisionModification extends Component
{
    public $division;
    public $officer;

    public function render()
    {
        $user = Auth::user();

        $this->division = Division::find($user->division);
        $this->officer = Officer::where('division', $user->division)->first();
        return view('livewire.division-modification');
    }
}
