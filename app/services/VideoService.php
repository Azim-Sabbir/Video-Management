<?php

namespace App\services;

use App\DTO\VideoData;
use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VideoService
{
    public function __construct(
        public array $filters = []
    ){}

    /**
     * get list of videos
     *
     * @return Collection
     */
public function getVideos(): Collection
{
    return Video::query()
        ->when(
            data_get($this->filters, 'category'),
            fn($query, $category) => $query->where(
                'category',
                'like',
                "%{$category}%"
            )
        )
        ->orderBy("created_at", "DESC")
        ->get();
}

    /**
     * store a video with file upload handling
     *
     * @param VideoRequest $request
     * @param VideoData $videoData
     * @return Video
     */
    public function storeVideo(VideoRequest $request, VideoData $videoData): Video
    {
        $validatedData = $request->validated();
        $thumbnailPath = $this->handleThumbnailUpload($request);

        if ($thumbnailPath) {
            $validatedData['thumbnail_path'] = $thumbnailPath;
        }

        unset($validatedData['thumbnail']);

        return Video::query()->create([
            "title" => $videoData->title,
            "duration" => $videoData->duration,
            "url" => $videoData->url,
            "thumbnail_path" => $videoData->thumbnail_path,
            "category" => $videoData->category,
        ]);
    }

    /**
     * Handle thumbnail file upload
     *
     * @param VideoRequest $request
     * @return string|null
     */
    private function handleThumbnailUpload(VideoRequest $request): ?string
    {
        if (!$request->hasFile('thumbnail')) {
            return null;
        }

        $thumbnailFile = $request->file('thumbnail');
        $filename = time() . '_' . uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();

        return $thumbnailFile->storeAs(
            'thumbnails',
            $filename,
            'public'
        );
    }

    /**
     * find a specific video by id
     *
     * @param $id
     * @return Model|Collection|Video|null
     */
    public function getVideo($id): Model|Collection|Video|null
    {
        return Video::query()->findOrFail($id);
    }


    /**
     *
     * apple filters for fetching videos
     *
     * @param array $filters
     * @return $this
     */
    public function appyFilters(array $filters): static
    {
        $this->filters = $filters;
        return $this;
    }

}
