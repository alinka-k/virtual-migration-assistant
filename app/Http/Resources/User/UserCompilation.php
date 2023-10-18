<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCompilation extends JsonResource
{
    public function toArray($request)
    {
        return [
            'compilationData' => $this->compilation_data,
        ];
    }
}
