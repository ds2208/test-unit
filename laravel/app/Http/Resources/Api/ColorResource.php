<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

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
            'name' => $this->name,
            'hex_value' => $this->hex_value,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
