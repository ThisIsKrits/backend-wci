<?php

namespace App\Http\Controllers\API\V1\Admin\PackageTour;

use App\Http\Controllers\Controller;
use App\Http\Resources\BenefitResource;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benefits = Benefit::latest()->get();

        return BenefitResource::collection($benefits)->additional([
            'success'   => true,
            'message'   => "List benefit"
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
            'tour_package_id'   => 'required',
            'content'           => 'required',
        ]);

        // check validator rules
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $benefit = Benefit::create([
            'tour_package_id'   => $request->tour_package_id,
            'content'           => $request->content,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data benefit successfully saved',
            'data'      => new BenefitResource($benefit)
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
        $validator = Validator::make($request->all(),[
            'tour_package_id'   => 'required',
            'content'           => 'required',
        ]);

        // check validator rules
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // find id benefit
        $benefit = Benefit::findOrFail($id);

        $benefit->update([
            'tour_package_id'   => $request->tour_package_id,
            'content'           => $request->content,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data benefit succesfully updated',
            'data'      => new BenefitResource($benefit)
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
        $benefit = Benefit::findOrFail($id);

        $benefit->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data benefit successfully deleted'
        ], 200);
    }
}
