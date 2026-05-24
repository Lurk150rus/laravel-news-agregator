<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\NewsFactory;

class News extends Model
{
    /** @use HasFactory<NewsFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'external_id',
        'content',
        'received_at',
        'source',
    ];
}
