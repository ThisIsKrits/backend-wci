<?php

namespace App\Http\Controllers\API\V1\Admin\Passport;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassportRegulationResource;
use App\Models\PassportRegulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassportRegulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regulations = PassportRegulation::latest()->get();

        return PassportRegulationResource::collection($regulations)->additional([
            "success"   => true,
            "message"   => "List regulation"
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
        //validator rules
        $validator  = Validator::make($request->all(), [
            "adult_id"      => "required",
            "passport_id"   => "required",
            "content"       => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->fails(), 422);
        }

        $regulation = PassportRegulation::create([
            "adult_id"      => $request->adult_id,
            "passport_id"   => $request->passport_id,
            "content"       => $request->content,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Passport regulation succesfully saved",
            "data"      => new PassportRegulationResource($regulation)
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
        $data = PassportRegulation::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail Regulation",
            "data"      => new PassportRegulationResource($data),
        ], 200);
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
        //validator rules
        $validator = Validator::make($request->all(), [
            "adult_id"      => "required",
            "passport_id"   => "required",
            "content"       => "nullable",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find id regulation
        $regulation = PassportRegulation::findOrFail($id);

        $regulation->update([
            "adult_id"      => $request->adult_id,
            "passport_id"   => $request->passport_id,
            "content"       => $request->content ?? $regulation->content,
        ]);

        return response()->json([
            "success"       => true,
            "message"       => "Regulation succesfully updated",
            "data"          => new PassportRegulationResource($regulation)
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
        // find id
        $regulation = PassportRegulation::findOrFail($id);

        $regulation->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Regulation succesfully deleted"
        ], 200);
    }
}
