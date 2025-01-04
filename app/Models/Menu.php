<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 
        'dish_name', 
        'dish_type', 
        'options',
    ];

    /**
     * Get the post that owns the menu.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
