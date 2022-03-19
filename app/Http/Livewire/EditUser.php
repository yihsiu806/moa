<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $userId;
    public $user;

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

        return view('livewire.edit-user');
    }
}
