<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $fillable = [
        'title',
        'duration',
        'url',
        'thumbnail_path',
        'category',
    ];

    protected $appends = [
        'thumbnail_url'
    ];

    /**
     * Get the full URL for the thumbnail
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail_path) {
            return null;
        }

        return Storage::disk('public')->url($this->thumbnail_path);
    }
}
