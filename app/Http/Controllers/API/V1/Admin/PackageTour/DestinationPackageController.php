<?php

namespace App\Http\Controllers\API\V1\Admin\PackageTour;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationPackageResource;
use App\Models\DestinationPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = DestinationPackage::latest()->get();

        return DestinationPackageResource::collection($destinations)->additional([
            'success'   => true,
            'message'   => 'List destination package'
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
            'city'      => 'required|unique:destination_packages',
            'country'   => 'required|unique:destination_packages',
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // destination create
        $destination = DestinationPackage::create([
            'city'      => $request->city,
            'country'   => $request->country,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data destination succesfully saved',
            'data'      => new DestinationPackageResource($destination)
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
            'city'      => 'required',
            'country'   => 'required',
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find id destination
        $destination = DestinationPackage::findOrFail($id);

        // update destination
        $destination->update([
            'city'      => $request->city,
            'country'   => $request->country,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data destination succesfully updated',
            'data'      => new DestinationPackageResource($destination)
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
        $destination = DestinationPackage::findOrFail($id);

        $destination->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data destination succesfully deleted',
        ], 200);
    }
}
