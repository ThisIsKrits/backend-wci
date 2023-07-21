<?php

namespace App\Http\Controllers\API\V1\Admin\Travel;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelDestinationResource;
use App\Models\TravelDestination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TravelDestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = TravelDestination::latest()->get();

        return TravelDestinationResource::collection($travels)->additional([
            "success"   => true,
            "message"   => "List Travel"
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation Rules
        $validator = Validator::make($request->all(),[
            "name"          => "required",
            "open"          => "nullable",
            "close"         => "nullable",
            "type_ticket"   => "required",
            "desc"          => "nullable",
            "destination_id"    => "required",
            "type_tour_id"      => "required",
            "image"             => "nullable|image|mimes:jpg,jpeg,png,webp|max:1028"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        // image upload
        if ($image = $request->file('image')) {
            $fileNameSave      = Str::uuid();
            $image->storeAs('public/travels', $fileNameSave);
        }

        $travel = TravelDestination::create([
            "name"          => $request->name,
            "open"          => $request->open ?? Carbon::createFromTimeString("08.00"),
            "close"         => $request->close ?? Carbon::createFromTimeString("17.00"),
            "type_ticket"   => $request->type_ticket,
            "desc"          => $request->desc ?? "",
            "destination_id"    => $request->destination_id,
            "type_tour_id"      => $request->type_tour_id,
        ]);

        $travel->getImage()->create([
            // "travel_destination_id" => $travel->id,
            "image"                 => $fileNameSave ?? "",
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Travel data succesfully saved",
            "data"      => new TravelDestinationResource($travel)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = TravelDestination::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail travel destination",
            "data"      => new TravelDestinationResource($data)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation rules
        $validator = Validator::make($request->all(), [
            "name"              => "required",
            "open"              => "nullable",
            "close"             => "nullable",
            "type_ticket"       => "required",
            "desc"              => "nullable",
            "destination_id"    => "required",
            "type_tour_id"      => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        // find id travel destination
        $travel = TravelDestination::findOrFail($id);

         // check if image not empty
         if($request->hasFile('image') && $request->file('image') != null)
         {
             if($request->hasFile('image')){
                 Storage::delete('public/travels/'. $travel->getImage->image);
             }

             $fileNameSave      = Str::uuid();
             $request->file('image')->storeAs('public/travels', $fileNameSave);
         }

        $travel->update([
            "name"              => $request->name,
            "open"              => $request->open ?? $travel->open,
            "close"             => $request->close ?? $travel->close,
            "type_ticket"       => $request->type_ticket,
            "desc"              => $request->desc ?? $travel->desc,
            "destination_id"    => $request->destination_id,
            "type_tour_id"      => $request->type_tour_id,
        ]);

        // update image
        $travel->getImage()->update([
            'travel_id'         => $travel->id,
            'image'             => $fileNameSave ?? $travel->getImage->image ?? " ",
        ]);


        return response()->json([
            "success"   => true,
            "message"   => "Travel data succesfully updated",
            "data"      => new TravelDestinationResource($travel)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travel = TravelDestination::findOrFail($id);

        $travel->delele();

        Storage::delete('public/travels/'. $travel->getImage->image);

        return response()->json([
            'success'   => true,
            'message'   => "Travel data succesfully deleted"
        ], 200);
    }
}
