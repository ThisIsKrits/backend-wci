<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::latest()->get();

        return new PartnerResource(true, 'List data partner', $partners);
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
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'image' => 'required|image|mimes:jpeg,png,svg,jpg|max:1028'
        ]);

        // check validation fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // upload image
        if ($image = $request->file('image')) {
            $fileNameSave      = Str::uuid();
            $image->storeAs('public/partners', $fileNameSave);
        }

        // create partner
        $partner = Partner::create([
            'name'  => $request->name,
            'image' => $fileNameSave
        ]);

        // return to response
        return new PartnerResource(true, 'Partner data successfully saved', $partner);

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
        // define validation rules
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'image'     => 'nullable|image|mimes:jpeg,jpg,png,svg|max:1028'
        ]);

        // check validation fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find partner id
        $partner = Partner::findOrFail($id);

        // check if image not empty
        if($request->hasFile('image') && $request->file('image') != null)
        {
            if($request->hasFile('image')){
                Storage::delete('public/partner/'. $partner->image);
            }

            $fileNameSave      = Str::uuid();
            $request->file('image')->storeAs('public/journies', $fileNameSave);
        }

        // update partner
        $partner->update([
            'name'      => $request->name,
            'image'     => $fileNameSave ?? $partner->image,
        ]);

        return new PartnerResource(true, 'Partner data successfully changed', $partner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id partner
        $partner = Partner::findOrFail($id);

        // delete partner
        $partner->delete();

        // delete image partner
        Storage::delete('public/partners/', $partner->image);

        return new PartnerResource(true,'Partner data deleted successfully', null);
    }
}
