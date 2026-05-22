<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'description',
        'external_id',
        'content',
        'received_at',
        'source',
    ];
}
