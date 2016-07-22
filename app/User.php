<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'users';
    public $timestamps = false;
    public $guarded = ['id'];
    protected $hidden = [
        'remember_token'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function path()
    {
        return route('users.show', ['user' => $this->id]);
    }
}