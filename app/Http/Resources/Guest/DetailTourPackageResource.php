<?php

namespace App\Http\Resources\Guest;

use App\Http\Resources\BenefitResource;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\JourneyResource;
use App\Http\Resources\TourTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailTourPackageResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'duration'          => $this->duration,
            'destination'       => new DestinationResource($this->destination),
            'type'              => new TourTypeResource($this->typeTour),
            'price'             => $this->price,
            'promo'             => $this->promo_price,
            'desc'              => $this->desc,
            'image'             => asset("storage/tours/". $this->getImage->image),
            'journey'           => JourneyResource::collection($this->journey)
        ];
    }
}
