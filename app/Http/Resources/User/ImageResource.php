<?php

namespace App\Http\Resources\User;

use App\Models\User\UserImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use URL;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $userImage = UserImage::firstWhere(['user_id' => $this->id]);
        $image_crop = Arr::get($userImage, 'image_crop');
        return [
            'image_origin' => Arr::get($userImage, 'image_origin'),
            'image_crop' => $image_crop ? URL::to('/') . '/storage/' . $image_crop : null,
        ];
    }
}
