<?php

namespace App\Http\Controllers\API\V1\Admin\Travel;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketTypesResource;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = TicketType::latest()->get();

        return TicketTypesResource::collection($types)->additional([
            "success"   => true,
            "message"   => "List type ticket"
        ], 2000);
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
        $validator = Validator::make($request->all(), [
            "adult_id"              => "required",
            "normal_price"          => "required|numeric",
            "promo_price"           => "nullable|numeric",
            "travel_package_id"     => "required"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $type = TicketType::create([
            "adult_id"          => $request->adult_id,
            "normal_price"      => $request->normal_price,
            "promo_price"       => $request->promo_price ?? 0,
            "travel_package_id" => $request->travel_package_id,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Type ticket succesfully saved",
            "data"      => new TicketTypesResource($type)
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
        // validation rules
        $validator = Validator::make($request->all(), [
            "adult_id"              => "required",
            "normal_price"          => "required|numeric",
            "promo_price"           => "nullable|numeric",
            "travel_package_id"     => "required"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $type = TicketType::findOrFail($id);

        $type->update([
            "adult_id"          => $request->adult_id,
            "normal_price"      => $request->normal_price,
            "promo_price"       => $request->promo_price ?? 0,
            "travel_package_id" => $request->travel_package_id,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Type ticket succesfully saved",
            "data"      => new TicketTypesResource($type)
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
        $type = TicketType::findOrFail($id);

        $type->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Type ticket succesfully deleted"
        ], 200);
    }
}
