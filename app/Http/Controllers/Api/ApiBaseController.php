<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiBaseController extends Controller
{
    /**
     * handle sending global success response
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function sendSuccessResponse(
        mixed $data,
        string $message = "Success",
        int $status = ResponseAlias::HTTP_OK
    )
    {
        return Response::json(
            [
                "status" => "success",
                "message" => $message,
                "data" => $data,
            ],
            $status
        );
    }

    public function sendFailedResponse(
        string $message = "Failed",
        int $status = ResponseAlias::HTTP_BAD_REQUEST
    )
    {
        return Response::json(
            [
                "status" => "failed",
                "message" => $message,
            ],
            $status
        );
    }
}
