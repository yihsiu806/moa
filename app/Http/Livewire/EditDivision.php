<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\Officer;

class EditDivision extends Component
{
    public $division;
    public $officer;
    public $divisionId;

    public function mount($id = null)
    {
        $this->divisionId = $id;
    }

    public function render()
    {
        $user = Auth::user();

        $id = $this->divisionId;

        if (!$id) {
            $id = $user->division;
        }

        $this->division = Division::find($id);
        $this->officer = Officer::where('division', $id)->first();

        return view('livewire.edit-division');
    }
}
