<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'wedding_date', 
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function guests(){
    return $this->hasMany(Guest::class);
    }

    public function collaborators()
    {
        return $this->hasMany(Collaborator::class, 'posts_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
