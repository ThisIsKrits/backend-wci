<?php

namespace App\Http\Resources\Guest;

use App\Http\Resources\BenefitResource;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\HotelTourResource;
use App\Http\Resources\JourneyResource;
use App\Http\Resources\TourTypeResource;
use App\Models\HotelTour;
use App\Models\Journey;
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
        $journey    = Journey::with('obtained')->where('tour_package_id', '=', $this->id)->get();
        $hotel      = HotelTour::with('price')->where('tour_package_id', '=', $this->id)->get();

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
            'journey'           => JourneyResource::collection($journey),
            'hotel'             => HotelTourResource::collection($hotel),
        ];
    }
}
