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
        // Admin dashboard will have division id
        $this->divisionId = $id;
    }

    public function render()
    {
        $user = Auth::user();

        // Admin dashboard -> edit division
        $id = $this->divisionId;

        // Division dashboard -> edit division
        if (!$id) {
            $id = $user->division;
        }

        $this->division = Division::find($id);
        $this->officer = Officer::where('division', $id)->first();

        return view('livewire.edit-division');
    }
}
