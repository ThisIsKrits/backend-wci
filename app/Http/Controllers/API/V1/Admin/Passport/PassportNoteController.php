<?php

namespace App\Http\Controllers\API\V1\Admin\Passport;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassportNoteResource;
use App\Models\PassportNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassportNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notes = PassportNote::latest()->get();

        return PassportNoteResource::collection($notes)->additional([
            "success"       => true,
            "message"       => "List passport note"
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
            "passport_id"       => "required",
            "note"              => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $note = PassportNote::create([
            "passport_id"       => $request->passport_id,
            "note"              => $request->note,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Passport note succesfully saved",
            "data"      => new PassportNoteResource($note)
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
        $data = PassportNote::findOrFail($id);

        return response()->json([
            "success"   => true,
            "message"   => "Detail note",
            "data"      => new PassportNoteResource($data)
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
            "passport_id"       => "required",
            "note"              => "required",
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find id passport note
        $note = PassportNote::findOrFail($id);

        $note->update([
            "passport_id"   => $request->passport_id,
            "note"          => $request->note,
        ]);

        return response()->json([
            "success"   => true,
            "message"   => "Passport note succesfully update",
            "data"      => new PassportNoteResource($note)
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
        //find id passport note
        $note = PassportNote::findOrFail($id);

        $note->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Passport note succesfully delete"
        ], 200);
    }
}
