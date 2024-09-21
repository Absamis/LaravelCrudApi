<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            "name" => $this->name,
            "category" => $this->category,
            "price" => $this->price,
            "discount_price" => $this->discount_price,
            "description" => $this->description,
            "contact" => $this->contact,
            "image" => $this->imageUrl
        ];
    }

    public function with($request){
        return [
            'version' => '1.0.0',
            'author_url' => url('https://www.nazmulrobin.com'),
        ];
    }
}
