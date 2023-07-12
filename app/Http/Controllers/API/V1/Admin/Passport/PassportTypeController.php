<?php

namespace App\Http\Controllers\API\V1\Admin\Passport;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassportTypeResource;
use App\Models\PassportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = PassportType::latest()->get();

        return PassportTypeResource::collection($types)->additional([
            "success"   => true,
            "message"   => "List Type Passport"
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
        // validator rules
        $validator = Validator::make($request->all(), [
            "content"       => "required",
            "passport_id"   => "required",
        ]);

        // check vaildator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $type = PassportType::create([
            "passport_id"   => $request->passport_id,
            "content"       => $request->content,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Type passport succesfully saved",
            "data"      => new PassportTypeResource($type)
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
        $data  = PassportType::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "detail type",
            "data"      => new PassportTypeResource($data)
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
        // validator rules
        $validator = Validator::make($request->all(), [
            "content"       => "required",
            "passport_id"   => "required",
        ]);

        // check vaildator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $type = PassportType::findOrFail($id);

        $type->update([
            "passport_id"   => $request->passport_id,
            "content"       => $request->content,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Type passport succesfully updated",
            "data"      => new PassportTypeResource($type)
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
        $type = PassportType::findOrFail($id);
        $type->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Type passport succesfully deleted"
        ], 200);
    }
}
