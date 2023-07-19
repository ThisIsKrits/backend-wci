<?php

namespace App\Http\Controllers\API\V1\Admin\PackageTour;

use App\Http\Controllers\Controller;
use App\Http\Resources\ObtainedResource;
use App\Models\Obtained;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObtainedJourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obtaineds = Obtained::latest()->get();

        return ObtainedResource::collection($obtaineds)->additional([
            'success'   => true,
            'message'   => 'List Obtained'
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
            'journey_id'    => 'required',
            'name'          => 'required'
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $obtained = Obtained::create([
            'journey_id'    => $request->journey_id,
            'name'          => $request->name,
        ], 201);

        return response()->json([
            'success'   => true,
            'message'   => 'Data obtain succesfully saved',
            'data'      => new ObtainedResource($obtained)
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
        $data = Obtained::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail Obtain",
            "data"      => new ObtainedResource($data)
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
            'journey_id'    => 'required',
            'name'          => 'required'
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $obtained = Obtained::findOrFail($id);
        $obtained->update([
            'journey_id'    => $request->journey_id,
            'name'          => $request->name,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data obtain succesfully updated',
            'data'      => new ObtainedResource($obtained)
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
        $obtained = Obtained::findOrFail($id);

        $obtained->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data obtained succesfully deleted'
        ], 200);
    }
}
