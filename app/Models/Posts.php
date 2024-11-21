<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post",
 *     required={"title", "author", "content", "tags"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="My First Post"),
 *     @OA\Property(property="author", type="string", example="John Doe"),
 *     @OA\Property(property="content", type="string", example="This is the content of the post."),
 *     @OA\Property(
 *         property="tags",
 *         type="array",
 *         @OA\Items(type="string", example="php")
 *     )
 * )
 */
class Posts extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'author',
        'content',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
