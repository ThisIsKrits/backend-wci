<?php

namespace App\Http\Controllers\API\V1\Admin\Travel;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelPackageResource;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = TravelPackage::latest()->get();

        return TravelPackageResource::collection($packages)->additional([
            "success"   => true,
            "message"   => "List Travel Package",
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
        //validation rules
        $validator = Validator::make($request->all(),[
            "name"                  => "required",
            "detail_ticket"         => "required",
            "info_ticket"           => "required",
            "travel_destination_id"             => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $package = TravelPackage::create([
            "name"              => $request->name,
            "detail_ticket"     => $request->detail_ticket,
            "info_ticket"       => $request->info_ticket,
            "travel_destination_id"         => $request->travel_destination_id,
        ]);


        return response()->json([
            "success"   => true,
            "message"   => "Travel package succesfully saved",
            'data'      => new TravelPackageResource($package)
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
        $validator = Validator::make($request->all(),[
            "name"              => "required",
            "detail_ticket"     => "nullable",
            "info_ticket"       => "nullable",
            "travel_destination_id"         => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        // find id package
        $package    = TravelPackage::findOrFail($id);

        $package->update([
            "name"          => $request->name,
            "detail_ticket" => $request->detail_ticket ?? $package->detail_ticket,
            "info_ticket"   => $request->info_ticket ?? $package->info_ticket,
            "travel_destination_id"     => $request->travel_destination_id
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Travel package succesfully updated",
            "data"      => new TravelPackageResource($package)
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
        $package    = TravelPackage::findOrFail($id);

        $package->delete();

        return response()->json([
            'success'   => true,
            'message'   => "Travel package succesfully deleted"
        ], 200);
    }
}
