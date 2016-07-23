<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $table = 'books';
    public $timestamps = false;
    public $fillable = ['title', 'author', 'year', 'genre'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}