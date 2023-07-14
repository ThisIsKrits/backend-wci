<?php

namespace App\Http\Controllers\API\V1\Admin\PackageTour;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaxHotelResource;
use App\Models\PaxHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaxHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paxs = PaxHotel::latest()->get();

        return PaxHotelResource::collection($paxs)->additional([
            'success'   => true,
            'message'   => 'List Pax Hotel'
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
        // validation rules
        $validator = Validator::make($request->all(),[
            'hotel_id'  => 'required',
            'pax'       => 'required',
            'price'     => 'required|numeric'
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // post data pax
        $pax = PaxHotel::create([
            'hotel_id'      => $request->hotel_id,
            'pax'           => $request->pax,
            'price'         => $request->price,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data pax hotel succesfully saved',
            'data'      => new PaxHotelResource($pax)
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
        $data = PaxHotel::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail pax hotel",
            "data"      => new PaxHotelResource($data)
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
        // validation rules
        $validator = Validator::make($request->all(),[
            'hotel_id'  => 'required',
            'pax'       => 'required',
            'price'     => 'required|numeric'
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find id pax
        $pax = PaxHotel::findOrFail($id);

        // update pax
        $pax->update([
            'hotel_id'      => $request->hotel_id,
            'pax'           => $request->pax,
            'price'         => $request->price,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data pax hotel succesfully updated',
            'data'      => new PaxHotelResource($pax)
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
        $pax = PaxHotel::findOrFail($id);

        $pax->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data pax succesfully deleted'
        ], 200);
    }
}
