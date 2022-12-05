<?php

namespace App\Http\Resources\User;

use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'full_name' => $this->full_name,
            'id_number' => $this->id_number,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'mobile' => $this->country_code.$this->mobile,
            'country' => new CountryResource($this->country),
            'gender' => $this->gender,
        ];
    }
}
