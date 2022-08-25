<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "id" => $this->id,
            "collection_code" => $this->collection_code,
            "collection_title" => $this->collection_title,
            "author" => $this->author,
            "publisher" => $this->publisher,
            "stock" => $this->stock,
            "current_stock" => $this->current_stock,
        ];
    }
}
