<?php

namespace App\Http\Controllers\API\V1\Admin\Visa;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisaResource;
use App\Models\Visa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $visas = Visa::latest()->paginate(5);

        return VisaResource::collection($visas)->additional([
            "success"       => true,
            "message"       => "List visa"
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
            "country_id"        => "required"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $visa = Visa::create([
            "country_id"        => $request->country_id
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Visa succesfully saved",
            "data"      => new VisaResource($visa)
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
        $visa = Visa::with(["visaType", "visaRegulation"])->findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail Visa",
            "data"      => new VisaResource($visa)
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
        //validation rules
        $validator = Validator::make($request->all(), [
            "country_id"    => "required"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find id visa
        $visa = Visa::findOrFail($id);

        $visa->update([
            "country_id"    => $request->country_id
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Visa succesfully updated",
            "data"      => new VisaResource($visa)
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
        //find id visa
        $visa = Visa::find($id);

        $visa->visaType()->delete();
        $visa->visaRegulation()->delete();
        $visa->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Visa succesfully delete"
        ], 200);
    }
}
