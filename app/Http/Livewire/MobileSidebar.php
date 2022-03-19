<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Division;

class MobileSidebar extends Component
{
    public $divisions;

    public function render()
    {
        $this->divisions = Division::select('name', 'icon', 'slug')
            ->orderBy('id')
            ->get();

        return view('livewire.mobile-sidebar');
    }
}
