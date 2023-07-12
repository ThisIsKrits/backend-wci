<?php

namespace App\Http\Controllers\API\V1\Admin\Visa;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisaTypeResource;
use App\Models\VisaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = VisaType::latest()->get();

        return VisaTypeResource::collection($types)->additional([
            "success"   => true,
            "message"   => "List type of visa"
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
        $validator = Validator::make($request->all(), [
            "visa_id"       => "required",
            "name"          => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $type = VisaType::create([
            "visa_id"       => $request->visa_id,
            "name"          => $request->name,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Visa type succesfully saved",
            "data"      => new VisaTypeResource($type)
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
        $validator = Validator::make($request->all(), [
            "visa_id"       => "required",
            "name"          => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }


        $type = VisaType::findOrFail($id);

        $type->update([
            "visa_id"       => $request->visa_id,
            "name"          => $request->name,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Visa type succesfully update",
            "data"      => new VisaTypeResource($type)
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
        //find id visa type
        $type = VisaType::findOrFail($id);

        $type->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Visa type succesfully delete"
        ], 200);
    }
}
