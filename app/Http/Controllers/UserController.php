<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $output =  User::orderBy('id','DESC')->get();
       return $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.profile');
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

        $this->validate($request,
        [
            'name' => 'required|min:3|max:100'
        ],[
            'name.required' => 'Field empty',
            'name.min' => 'Field so short',
            'name.max' => 'Field so long'
        ]);

        DB::beginTransaction();

        try {
            $output = User::create($input);
        } catch(\Throwable $e) {
            DB::rollback();
            throw $e;
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
        $output = User::find($id);
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
        return view('users.profile');
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
            'name' => 'required|min:3|max:100'
        ],[
            'name.required' => 'Field empty',
            'name.min' => 'Field so short',
            'name.max' => 'Field so long'
        ]);

        DB::beginTransaction();

        try {
            $output = User::where('id',$id)->update($input);
        } catch(\Throwable $e) {
            DB::rollback();
            throw $e;
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

            $output = User::where('id',$id)->delete();
            
        } catch(\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();

        return response()->json($output, 204);
    }
}
