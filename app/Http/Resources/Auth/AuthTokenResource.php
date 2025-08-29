<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'token' => $this['token'],
            'token_type' => 'Bearer',
            'user' => new UserResource($this['user']),
        ];
    }
}
