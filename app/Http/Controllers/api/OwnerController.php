<?php

namespace App\Http\Controllers\api;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Hash;
use Config;
use Tymon\JWTAuth\Exceptions\JWTException;

class OwnerController extends Controller
{

    function __construct()
    {
        Config::set('jwt.user', Owner::class);
        Config::set('auth.defaults', ['guard' => 'owner', 'passwords' => 'users']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = Owner::where('is_delete', false)->orderBy('id','DESC')->get();
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
            $input['pass'] = Hash::make($input['pass']);
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
        $output = Owner::where('is_delete', false)->find($id);
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

            $output = Items::where('id', $id)->update(array('is_delete' => true));
            
        } catch(\Throwable $e) {
            DB::rollback();
            return response()->json(['server busy'], 400);
        }
        DB::commit();

        return response()->json($output, 204);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $input  = $request->all();
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:owner',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
        ]);

        if (isset($input['note'])) {
            $input['note'] = json_encode($input['note']);
        }
        DB::beginTransaction();
        try {
            $input['password'] = Hash::make($input['password']);
            unset($input['password_confirmation']);
            $user = Owner::create($input);
            $token = JWTAuth::fromUser($user);

        } catch(\Throwable $e) {
            DB::rollback();
            return response()->json(['server busy'], 400);
        }
        DB::commit();

        return response()->json(compact('user','token'), 201);
    }

    public function getAuthenticatedUser()
        {
            try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('user'));
        }
}
