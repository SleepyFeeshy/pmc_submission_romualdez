<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'name',
        'title',
    ];

    // A book belongs to an author.
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
