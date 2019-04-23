<?php

namespace App\Http\Controllers\api;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = Owner::orderBy('id','DESC')->get();
        return $output;
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
        $input  = $request->all();
        var_dump($input);
        $this->validate($request, [
            'id' => 'required|min:3|max:100'
        ],[
            'id.required' => 'Field empty',
            'id.min' => 'Field so short',
            'id.max' => 'Field so long'
        ]);

        DB::beginTransaction();
        try {
            if (isset($input['note'])) {
                $input['note'] = json_encode($input['note']);
            }
            $input['pass'] = bcrypt($input['pass']);
            $output = Owner::create($input);
        } catch(\Throwable $e) {
            DB::rollback();
            return response()->json(['server busy'], 400);
        }
        DB::commit();

        return response()->json($output, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $output = Owner::find($id);
        return $output;
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
        $input  = $request->all();

        $this->validate($request,
        [
            'id' => 'required|min:3|max:100'
        ],[
            'id.required' => 'Field empty',
            'id.min' => 'Field so short',
            'id.max' => 'Field so long'
        ]);
        
        DB::beginTransaction();
        try {
            $output = Owner::where('id',$id)->update($input);
        } catch(\Throwable $e) {
            DB::rollback();
            return response()->json(['server busy'], 400);
        }
        DB::commit();

        return response()->json($output, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $output = Owner::where('id',$id)->delete();
            
        } catch(\Throwable $e) {
            DB::rollback();
            return response()->json(['server busy'], 400);
        }
        DB::commit();

        return response()->json($output, 204);
    }
}
