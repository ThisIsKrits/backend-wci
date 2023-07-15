<?php

namespace App\Http\Controllers\API\V1\Admin\PackageTour;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourPackageResource;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TourPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = TourPackage::latest()->get();

        return TourPackageResource::collection($packages)->additional([
            'success'   => true,
            'message'   => 'List tour package'
        ]);
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
            'name'              => 'required',
            'duration'          => 'nullable',
            'destination_id'    => 'required',
            'type_tour_id'      => 'required',
            'price'             => 'nullable|numeric',
            'promo_price'       => 'nullable|numeric',
            'desc'              => 'nullable',
            'image'             => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // check validation fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // image upload
        if ($image = $request->file('image')) {
            $fileNameWithExt   = $image->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $image->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $image->storeAs('public/tours', $fileNameSave);
        }

        $package = TourPackage::create([
            'name'              => $request->name,
            'duration'          => $request->duration,
            'destination_id'    => $request->destination_id,
            'type_tour_id'      => $request->type_tour_id,
            'price'             => $request->price,
            'promo_price'       => $request->promo_price,
            'desc'              => $request->desc ?? "",
        ]);

        $package->getImage()->create([
            'tour_package_id'   => $package->id,
            'image'             => $fileNameSave,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data tour package succesfully saved',
            'data'      => new TourPackageResource($package)
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
        $data = TourPackage::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail package",
            "data"      => new TourPackageResource($data)
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
         // validation rules
         $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'duration'          => 'nullable',
            'destination_id'    => 'required',
            'type_tour_id'      => 'required',
            'price'             => 'nullable|numeric',
            'promo_price'       => 'nullable|numeric',
            'desc'              => 'nullable',
            'image'             => 'nullable|max:2048'
        ]);

        // check validation fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $package = TourPackage::findOrFail($id);

         // check if image not empty
         if($request->hasFile('image') && $request->file('image') != null)
         {
             if($request->hasFile('image')){
                 Storage::delete('public/tours/'. $package->image->image);
             }

             $fileNameSave      = Str::uuid();
             $request->file('image')->storeAs('public/tours', $fileNameSave);
         }

        $package->update([
            'name'              => $request->name,
            'duration'          => $request->duration,
            'destination_id'    => $request->destination_id,
            'type_tour_id'      => $request->type_tour_id,
            'price'             => $request->price,
            'promo_price'       => $request->promo_price,
            'desc'              => $request->desc ?? $package->desc,
        ]);

        $package->getImage->update([
            'tour_package_id'   => $package->id,
            'image'             => $fileNameSave ?? $package->getImage->image,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data tour package succesfully updated',
            'data'      => new TourPackageResource($package)
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
        $package = TourPackage::findOrFail($id);

        Storage::delete('public/tours/'. $package->getImage->image);
        $package->getImage()->delete();

        $package->delete();


        return response()->json([
            'success'   => true,
            'message'   => 'Data tour package succesfully deleted'
        ], 200);
    }
}
