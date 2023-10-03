<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\JWT;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private function responsePlaceholder($url=null){
        return [
            'result' => 'success',
            'url' => $url ?? redirect()->back()->getTargetUrl()
        ];
    }
    public function index()
    {
        $users = User::all();
        return view('user.users', compact('users'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('user.form', compact('roles'));
    }


    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request['password']);
        $roles = $data['roles'];
        unset($data['roles']);
        $user = User::create($data);
        $user->roles()->sync($roles);
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        $token = auth('api')->tokenById($user->id);
        return view('user.form', compact('roles', 'user', 'token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $data['password'] = $data['password'] ? Hash::make($request['password']) : $user->password;
        $roles = $data['roles'];
        unset($data['roles']);
        $user->update($data);
        $user->roles()->sync($roles);
        return response()->json(
            $this->responsePlaceholder($request->headers->get('referer'))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    public function notificationRead(){
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
    }
}
