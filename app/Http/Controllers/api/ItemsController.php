<?php

namespace App\Http\Controllers\api;

use App\Models\Items;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use Illuminate\Support\Facades\DB;

class ItemsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = Items::where('is_delete', false)->orderBy('id','DESC')->get();
        return $this->sendResponse($output, 'items retrieved successfully');
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
            $output = Items::create($input);
        } catch(\Throwable $e) {
            DB::rollback();
            return $this->sendError('server busy', null);
        }
        DB::commit();

        return $this->sendResponse($output, 'items created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $output = Items::where('is_delete', false)->find($id);
        return $this->sendResponse($output, 'items retrieved successfully');
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
            $output = Items::where('id',$id)->update($input);
        } catch(\Throwable $e) {
            DB::rollback();
            return $this->sendError('server busy', null);
        }
        DB::commit();

        return $this->sendResponse($output, 'items updated successfully.');
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
            $output = Items::where('id', $id)->update(array('is_delete' => true));
        } catch(\Throwable $e) {
            DB::rollback();
            return $this->sendError('server busy', null);
        }
        DB::commit();

        return $this->sendResponse($output, 'items deleted successfully.');
    }
}
