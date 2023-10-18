<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $refreshToken = User::firstWhere('id', $this->id)->remember_token;

        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'created_at' => $this->created_at,
            'termsAccepted' => boolOrNull($this->terms_accepted),
            'is_profile_imported' => boolOrNull($this->is_profile_imported),
            'compilationPercent' => $this->compilation->percent ?? 0,
            'canProfileBeEvaluated' => $this->compilation->can_profile_be_evaluated ?? false,
            'refresh_token' => $refreshToken,
            'startTour' => $this->getIsFirstLogin(),
        ];
    }
}
