<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Files;

class FileEdit extends Component
{
    public $fileId;
    public $file;

    public function mount($id = null)
    {
        $this->fileId = $id;
    }

    public function render()
    {
        $this->file = Files::where('id', '=', $this->fileId)->first();

        return view('livewire.file-edit');
    }

    public function write_log($log_msg)
    {
        $log_filename = "/home/yihsiu/logs";
        if (!file_exists($log_filename)) {
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename . '/debug.log';
        file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }
}
