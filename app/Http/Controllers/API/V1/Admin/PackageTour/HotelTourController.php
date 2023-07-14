<?php

namespace App\Http\Controllers\API\V1\Admin\PackageTour;

use App\Http\Controllers\Controller;
use App\Http\Resources\HotelTourResource;
use App\Models\HotelTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = HotelTour::latest()->get();

        return HotelTourResource::collection($hotels)->additional([
            'success'   => true,
            'message'   => 'List Hotel'
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
        $validator  = Validator::make($request->all(),[
            'tour_package_id'   => 'required',
            'name'              => 'required',
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // post data hotel
        $hotel = HotelTour::create([
            'tour_package_id'   => $request->tour_package_id,
            'name'              => $request->name
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data hotel succesfully saved',
            'data'      => new HotelTourResource($hotel)
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
        $data = HotelTour::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail hotel",
            "data"      => new HotelTourResource($data)
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
         $validator  = Validator::make($request->all(),[
            'tour_package_id'   => 'required',
            'name'              => 'required',
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // post data hotel
        $hotel = HotelTour::findOrFail($id);

        $hotel->update([
            'tour_package_id'   => $request->tour_package_id,
            'name'              => $request->name
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data hotel succesfully updated',
            'data'      => new HotelTourResource($hotel)
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
        //find id hotel
        $hotel = HotelTour::findOrFail($id);

        $hotel->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data hotel succesfully deleted'
        ],200);
    }
}
