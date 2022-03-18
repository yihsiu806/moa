<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Division;

class AdminDashboard extends Component
{
    public $users;

    public function render()
    {
        $this->users = User::select(
            'users.username',
            'users.role',
            'users.updated_at',
            'divisions.name as division'
        )
            ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
            ->get();

        return view('livewire.admin-dashboard');
    }
}
