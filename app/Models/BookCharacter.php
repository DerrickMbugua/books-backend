<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BookCharacter extends Model
{
    protected $table = 'book_characters';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id', 'character_id'
    ];

}
