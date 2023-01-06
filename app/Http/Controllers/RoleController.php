<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all();

        return view('role.index', compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::get()->pluck('title', 'title');
        return view('role.create',compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        //Role::create($request->except(''));
        $role = Role::create($request->validated());
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        if(count($permissions)>0){
            $permissions_data=array();
            for($i=0, $iMax = count($permissions); $i< $iMax; $i++){
                $permissions_=Permission::where('title','=',$permissions[$i])->get();

                foreach ($permissions_ as $pr){
                    $permissions_data[]=$pr['id'];
                }
            }
        }
       $role->permissions()->sync($permissions_data);
        return redirect()->route('role.index');
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->load('permissions');
        return view('role.show', compact('role'));
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::get()->pluck('title', 'title');
        return view('role.edit', compact('role','permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
     $role->update($request->validated());
        //$role->update($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        if(count($permissions)>0){
            $permissions_data=array();
            for($i=0, $iMax = count($permissions); $i< $iMax; $i++){
                $permissions_=Permission::where('title','=',$permissions[$i])->get();

                foreach ($permissions_ as $pr){
                  $permissions_data[]=$pr['id'];
                }
            }
        }
        $role->permissions()->sync($permissions_data);
        return redirect()->route('role.index');
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return redirect()->route('role.index');
    }
}
