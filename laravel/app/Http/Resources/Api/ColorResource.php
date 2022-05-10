<?php

namespace App\Http\Resources\Api\Filter;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->getData();
    }

    protected function getData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'hex_value' => $this->hex_value,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
