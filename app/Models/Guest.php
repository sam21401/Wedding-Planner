<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Guest",
 *     type="object",
 *     title="Guest",
 *     properties={
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="John"),
 *         @OA\Property(property="surname", type="string", example="Doe"),
 *         @OA\Property(property="phone", type="string", example="+123456789"),
 *         @OA\Property(property="email", type="string", example="guest@example.com"),
 *         @OA\Property(property="status", type="string", example="invited"),
 *         @OA\Property(property="token", type="string", example="abc123"),
 *         @OA\Property(property="user_id", type="integer", example=2)
 *     }
 * )
 */


class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'status',
        'token',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
