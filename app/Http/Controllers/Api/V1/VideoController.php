<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\VideoData;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\VideoRequest;
use App\services\VideoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends ApiBaseController
{
    public function index(Request $request)
    {
        try {
            $categoryFilter = $request->query('category');
            $videos = app(VideoService::class)
                ->appyFilters([
                    "category" => $categoryFilter,
                ])
                ->getVideos();

            return $this->sendSuccessResponse($videos);
        } catch (\Exception $exception) {
            return $this->sendFailedResponse($exception->getMessage());
        }
    }

    public function store(VideoRequest $request)
    {
        try {
            $videoData = VideoData::toArray($request->validated());

            $video = app(VideoService::class)
                ->storeVideo(
                    $request,
                    $videoData
                );

            return $this->sendSuccessResponse($video);
        }
        catch (\Exception $exception) {
            return $this->sendFailedResponse($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $video = app(VideoService::class)->getVideo($id);

            return $this->sendSuccessResponse($video);
        }catch (\Exception $exception) {
            return $this->sendFailedResponse($exception->getMessage());
        }
    }
}
