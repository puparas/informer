<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class RoleController extends Controller
{
    private function responsePlaceholder(){
        return [
            'result' => 'success',
            'url' => redirect()->back()->getTargetUrl()
        ];
    }
    public function index()
    {
        $roles = Role::all();
        return view('role.roles', compact('roles'));
    }


    public function create()
    {

        $perms = Permission::all();
        return view('role.form', compact('perms'));
    }


    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $perms = $data['permissions'];
        unset($data['permissions']);
        $role = Role::create($data);
        $role->permissions()->sync($perms);
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }


    public function edit(Role $role)
    {
        $perms = Permission::all();
        return view('role.form', compact('perms', 'role'));
    }


    public function update(RoleRequest $request, Role $role)
    {

        $data = $request->validated();
        $perms = $data['permissions'];
        unset($data['permissions']);
        $role::where('id', $request->id)->update($data);
        $role->permissions()->sync($perms);
        return response()->json(
            $this->responsePlaceholder()
        );
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(
            $this->responsePlaceholder()
        );
    }
}
