<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private static $plainTextToken;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'login' => $this->login,
            'birth' => $this->lastname,
            'registered' => $this->created_at,

        ];

        if(!empty(self::$plainTextToken))
        {
            $data += [
                'token' => self::$plainTextToken
            ];
        }

        return $data;
    }

    public function setPlainTextToken($plainTextToken, $request): array
    {
        self::$plainTextToken = $plainTextToken;
        return $this->toArray($request);
    }
}
