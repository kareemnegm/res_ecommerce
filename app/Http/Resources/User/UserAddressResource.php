<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'address'=>$this->address,
            'street'=>$this->street,
            'nearest_landmark'=>$this->nearest_landmark,
            'notes'=>$this->notes,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'user_id'=>$this->user_id,
            'is_default'=>$this->is_default,
        ];
    }
}
