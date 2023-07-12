<?php

namespace App\Http\Controllers\API\V1\Admin\Passport;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassportResource;
use App\Models\Passport;
use App\Models\PassportRegulation;
use App\Models\PassportRegulationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passports = Passport::latest()->get();


        return PassportResource::collection($passports)->additional([
            "success"   => true,
            "message"   => "List Passport"
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
        $validator = Validator::make($request->all(),[
            "country_id"                    => "required",
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }


        $passport = Passport::create([
            "country_id"    => $request->country_id,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Passport succesfully saved",
            "data"      => new PassportResource($passport),
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
        // find id passport
        $passport = Passport::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail Passport",
            "data"      => new PassportResource($passport)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $passport = Passport::findOrFail($id);

        $passport->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Passport succesfully delete"
        ]);
    }
}
