<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'from',
        'to',
        'download',
        'path',
        'owner',
        'division',
    ];
}
