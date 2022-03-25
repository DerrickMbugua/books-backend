<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    protected $table = 'book_authors';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id', 'author_id'
    ];

}
