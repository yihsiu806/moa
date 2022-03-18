<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Files;
use App\Models\User;

class Welcome extends Component
{
    public $files;
    public function render()
    {
        $this->files = Files::select(
            'files.title',
            'files.description',
            'files.from',
            'files.to',
            'files.download',
            'files.path',
            'files.updated_at',
            'users.username as owner',
            'divisions.name as division',
        )
            ->leftJoin('users', 'users.id', '=', 'files.owner')
            ->leftJoin('divisions', 'divisions.id', '=', 'files.division')
            ->get();

        return view('livewire.welcome');
    }
}
