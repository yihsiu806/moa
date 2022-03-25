<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Division;

class EditUser extends Component
{
    public $userId;
    public $user;
    public $divisions;

    public function mount($id)
    {
        $this->userId = $id;
    }

    public function render()
    {
        $this->user = User::select(
            'id',
            'username',
            'role',
            'division',
        )->where('id', '=', $this->userId)->first();

        $this->divisions = Division::select('id', 'name')->get();

        return view('livewire.edit-user');
    }
}
