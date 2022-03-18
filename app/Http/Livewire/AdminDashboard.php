<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Division;

class AdminDashboard extends Component
{
    public $users;
    public $divisions;

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

        $this->divisions = Division::select(
            'divisions.name',
            'divisions.icon',
            'divisions.updated_at',
            'officers.name as officer'
        )
            ->leftJoin('officers', 'officers.division', '=', 'divisions.id')
            ->get();

        return view('livewire.admin-dashboard');
    }
}
