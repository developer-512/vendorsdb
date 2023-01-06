<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with('roles')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {

        $role = Role::find($request->roles);
            $request->merge([
                'password' => Hash::make($request->input('password')),
            ]);
        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles',$request->roles));
        User::where('id','=',$user->id)->update(['role' => $role->title]);

        return redirect()->route('users.index')->with('message','User updated Successfully');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');


        $user->load('roles');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {


        //print_r($request->validated());exit;
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', $request->roles));
        $role = Role::find($request->roles);
        User::where('id','=',$user->id)->update(['role' => $role->title]);
        if(!empty($request->input('password'))){
            User::where('id','=',$user->id)->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        return redirect()->route('users.index')->with('info','User updated Successfully');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('users.index')->with('error','User deleted Successfully');
    }
}
