<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'icon',
        'status',
        'features',
        'specifications',
        'tutorial',
        'others_data',
        'details_description',
        'seo',
    ];

    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
        'tutorial' => 'array',
        'others_data' => 'array',
        'details_description' => 'array',
        'status' => 'boolean',
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
