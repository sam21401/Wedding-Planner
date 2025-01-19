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

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'collaborators', 'post_id', 'user_id')
                    ->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function guests(){
    return $this->hasMany(Guest::class);
    }



    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
