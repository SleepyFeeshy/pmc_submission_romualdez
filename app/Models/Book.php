<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    //
    protected $fillable = [
        'name',
        'title',
        'published_date'
    ];

    // A book belongs to an author.
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
