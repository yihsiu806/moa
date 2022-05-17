<?php

namespace App\Http\Livewire;

use App\Models\Files;
use App\Models\Division;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SearchResult extends Component
{
    public $searchQuery;

    public function mount($query = null)
    {
        $this->searchQuery = $query;
    }

    public function render()
    {
        return view('livewire.search-result');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $start = intval($request->input('start'));
        $totalRecord = Files::count();
        $count = 0;
        $result = [];
        $columns = ['title', 'description', 'from', 'to', 'download'];

        do {
            $query = Files::select(
                'files.id as DT_RowId',
                'files.title',
                'files.description',
                'files.from',
                'files.to',
                DB::raw("CONCAT(files.from, ' ~ ', files.to) as duration"),
                'files.download',
                'files.path',
                'files.updated_at',
                'divisions.name as division',
            )
                ->leftJoin('divisions', 'divisions.id', '=', 'files.division')
                ->orderBy('updated_at', 'desc')
                ->skip($start)->take(10);

            $files = $query->get();
            // foreach ($columns as $column) {
            //     $query = $query->orWhere($column, 'LIKE', '%' . $searchQuery . '%');
            // }

            // $queryResult = $query->get();
            // foreach ($queryResult as $qr) {
            //     $result[] = $qr;
            // }

            foreach ($files as $file) {
                $content = file_get_contents(Storage::disk('myDisk')->path($file->path));
                // if (strpos($content, $searchQuery) !== false) {
                //     // Bingo
                // }
            }

            $count = count($result);
            $start += 10;
        } while ($count < 10 || $start > $totalRecord);
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
