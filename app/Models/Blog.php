<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content',
        'status',
        'category_id',
    ];

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%");
        });
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
