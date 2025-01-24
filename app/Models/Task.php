<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;





class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'title',
        'description',
        'status',
        'responsible_user_id',
        'deadline',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function responsibleUser()
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }

    public function notes()
    {
        return $this->hasMany(TaskNote::class);
    }

}
