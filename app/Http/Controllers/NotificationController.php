<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\SendNotificationRequest;
use App\Http\Services\NotificationService;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function __construct(private readonly NotificationService $service)
    {
    }

    /**
     * @param SendNotificationRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function send(SendNotificationRequest $request): JsonResponse
    {
        $data = $request->validated();
        $res = $this->service->send($data['title'], $data['description'], $data['user_id']);
        return successResponse($res, 'notification sent successfully');
    }

    /**
     * @param $notifId
     * @return JsonResponse
     * @throws CustomException
     */
    public function markAsSeen($notifId): JsonResponse
    {
        $this->service->markAsSeen($notifId);
        return successResponse(null, 'notification marked as seen successfully');
    }
}
