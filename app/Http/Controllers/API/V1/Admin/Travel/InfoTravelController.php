<?php

namespace App\Http\Controllers\API\V1\Admin\Travel;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfoTravelResource;
use App\Models\InfoTravel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfoTravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = InfoTravel::latest()->get();

        return InfoTravelResource::collection($infos)->additional([
            "success"   => true,
            "message"   => "List info travel"
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
            "travel_destination_id"     => "required",
            "content"       => "nullable",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $info = InfoTravel::create([
            "travel_destination_id"     => $request->travel_destination_id,
            "content"       => $request->content ?? "",
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Info travel succesfully saved",
            "data"      => new InfoTravelResource($info),
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
            "travel_destination_id"     => "required",
            "content"       => "nullable",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $info = InfoTravel::findOrFail($id);
        $info->update([
            "travel_destination_id"     => $request->travel_destination_id,
            "content"       => $request->content ?? "",
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Info travel succesfully updated",
            "data"      => new InfoTravelResource($info)
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
        $info = InfoTravel::findOrFail($id);

        $info->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Info travel succesfully deleted"
        ], 200);
    }
}
