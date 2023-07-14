<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->get();

        return ClientResource::collection($clients)->additional([
            "success"   => true,
            "message"   => "List client"
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
            "name"      => "required",
            "image"     => "required|image|mimes:jpg,jpeg,png|max:1028"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

         // image upload
         if ($image = $request->file('image')) {
            $fileNameSave      = Str::uuid();
            $image->storeAs('public/clients', $fileNameSave);
        }

        $client = Client::create([
            "name"      => $request->name,
            "image"     => $fileNameSave
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Client data succesfully saved",
            "data"      => new ClientResource($client)
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
        $data = Client::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail client",
            "data"      => new ClientResource($data)
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
            "name"      => "required",
            "image"     => "nullable|max:1028"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        // find id travel destination
        $client = Client::findOrFail($id);

         // check if image not empty
         if($request->hasFile('image') && $request->file('image') != null)
         {
             if($request->hasFile('image')){
                 Storage::delete('public/clients/'. $client->image);
             }

             $fileNameSave      = Str::uuid();
             $request->file('image')->storeAs('public/clients', $fileNameSave);
         }

        $client->update([
            "name"      => $request->name,
            "image"     => $fileNameSave ?? $client->image,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Client data succesfully saved",
            "data"      => new ClientResource($client)
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
        $client = Client::findOrFail($id);

        $client->delete();
        Storage::delete('public/clients/'. $client->image);

        return response()->json([
            "success"   => true,
            "message"   => "Client data succesfully deleted"
        ], 200);

    }
}
