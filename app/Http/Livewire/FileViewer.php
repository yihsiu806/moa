<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Division;
use App\Models\Officer;
use Illuminate\Support\Facades\DB;

class FileViewer extends Component
{
    public $slug;
    public $division;
    public $officer;
    public $files;

    public function mount($slug)
    {
        $this->$slug = $slug;
    }

    public function render()
    {
        $this->division = Division::select(
            'divisions.id',
            'divisions.name',
            'divisions.picture',
        )
            ->where('slug', '=', $this->slug)
            ->first();

        $currentDivision = Division::select('divisions.id')
            ->where('slug', '=', $this->slug)
            ->first();

        $this->officer = Officer::select(
            'name',
            'position',
            'telephone',
            'email',
            'picture'
        )
            ->where('division', '=', $currentDivision->id)
            ->first();

        $this->files = DB::table('files')->select(
            'title',
            'description',
            'from',
            'to',
            'download',
            'path',
            'owner'
        )
            ->where('files.division', '=', $currentDivision->id)
            ->get();

        return view('livewire.file-viewer');
    }
}
