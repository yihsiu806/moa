<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Division;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;

class Sidebar extends Component
{
    public $divisions;
    public $filesCount;
    public $sizeCount;

    public function render()
    {
        $this->divisions = Division::select('name', 'icon', 'slug')
            ->orderBy('id')
            ->get();

        $this->filesCount = Files::count();

        $this->sizeCount = $this->formatBytes($this->get_dir_size(Storage::disk('myDisk')->path('/')));

        return view('livewire.sidebar');
    }

    public function get_dir_size($directory)
    {
        $size = 0;
        $files = glob($directory . '/*');
        foreach ($files as $path) {
            is_file($path) && $size += filesize($path);
            // is_dir($path)  && $size += get_dir_size($path);
        }
        return $size;
    }

    public function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow)); 

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
