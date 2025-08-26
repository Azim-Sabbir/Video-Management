<?php

namespace App\DTO;

readonly class VideoData
{
 public function __construct(
     public string $title,
     public string $duration,
     public string $url,
     public ?string $thumbnail_path = null,
     public ?string $category = null,
 ){}

    public static function toArray(array $data): VideoData
    {
        return new VideoData(
            data_get($data, 'title'),
            data_get($data, 'duration'),
            data_get($data, 'url'),
            data_get($data, 'thumbnail_path'),
            data_get($data, 'category'),
        );
    }
}
