<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function comments(){
     return $this->hasMany(Comment::class);
    }

    public function authors(){
        return $this->belongsToMany('App\Models\Author', 'book_authors', 'book_id', 'author_id');
    }

    public function characters(){
        return $this->belongsToMany(Character::class, 'book_characters', 'book_id', 'character_id');
    }
}
