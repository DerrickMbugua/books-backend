<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'characters';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gender'
    ];

    public function books(){
        return $this->belongsToMany(Book::class, 'book_characters', 'character_id','book_id');
    }
}
