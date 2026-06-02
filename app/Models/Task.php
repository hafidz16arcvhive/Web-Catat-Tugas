<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
   protected $fillable = [
    'judul',
    'deskripsi',
    'is_done',
    'deadline',
    'user_id'
];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sharedUsers()
    {
        return $this->belongsToMany(User::class);
    }
}

