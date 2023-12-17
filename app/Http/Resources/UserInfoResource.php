<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'notifications' => NotificationResource::collection($this->notifications),
            'tasks' => TaskResource::collection($this->tasks),
            'username' => $this->username,
            'createdAt' => Carbon::parse($this->created_at)->format('Y/m/d'),
        ];
    }
}
