<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'details_description',
        'image',
        'status',
        'features',
        'specifications',
        'tutorial',
        'others_data',
        'seo',
    ];

    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
        'details_description' => 'array',
        'description' => 'array',
        'tutorial' => 'array',
        'others_data' => 'array',
        'seo' => 'array',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image && \Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
