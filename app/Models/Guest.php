<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'name',
        'email',
        'status',
        'status_updated_at',
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
