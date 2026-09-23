<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

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
