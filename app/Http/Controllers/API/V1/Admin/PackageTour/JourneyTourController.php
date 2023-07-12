<?php

namespace App\Http\Controllers\API\V1\Admin\PackageTour;

use App\Http\Controllers\Controller;
use App\Http\Resources\JourneyResource;
use App\Models\Journey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JourneyTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journies = Journey::orderBy("day","ASC")->get();

        return JourneyResource::collection($journies)->additional([
            'success'   => true,
            'message'   => 'List journies'
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
         $validator = Validator::make($request->all(), [
            'tour_package_id'   => 'required',
            'day'               => 'required|numeric',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:1028',
            'desc'              => 'nullable',
        ]);

        // check validator
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        // image upload
        if ($image = $request->file('image')) {
            $fileNameSave      = Str::uuid();
            $image->storeAs('public/journies', $fileNameSave);
        }

        $journey = Journey::create([
            'tour_package_id'       => $request->tour_package_id,
            'day'                   => $request->day,
            'image'                 => $fileNameSave,
            'desc'                  => $request->desc ?? "",
        ], 201);

        return response()->json([
            'success'   => true,
            'message'   => 'Data journey succesfully saved',
            'data'      => new JourneyResource($journey)
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
            'tour_package_id'   => 'required',
            'day'               => 'required|numeric',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:1028',
            'desc'              => 'nullable',
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find id journey
        $journey = Journey::findOrFail($id);

        // check if image not empty
        if($request->hasFile('image') && $request->file('image') != null)
        {
            if($request->hasFile('image')){
                Storage::delete('public/journies/'. $journey->image);
            }

            $fileNameSave      = Str::uuid();
            $request->file('image')->storeAs('public/journies', $fileNameSave);
        }

        $journey->update([
            'tour_package_id'       => $request->tour_package_id,
            'day'                   => $request->day,
            'image'                 => $fileNameSave ?? $journey->image,
            'desc'                  => $request->desc,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => "Data journey sucessfully updated",
            'data'      => new JourneyResource($journey)
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
        // find id journey
        $journey = Journey::findOrFail($id);

        // delete journ$journey
        $journey->delete();

        // delete image partner
        Storage::delete('public/journies/', $journey->image);

        return response()->json([
            'success'   => true,
            'message'   => 'Data journey successfully deleted'
        ], 200);
    }
}
