<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = [
        'name',
        'birth_date',
    ];

    // An author has books books.
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
