<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'wedding_date',
        'venue_name',
        'venue_address',
        'latitude',
        'longitude',
        'theme',
        'estimated_cost',
        'dress_code',
        'food_options',
        'rsvp_deadline',
        'transportation_notes',
        'gifts',
        'music_type',
        'host',
        'with_children',
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

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
