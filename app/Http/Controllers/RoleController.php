<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['editRole','updateRole']]);
        $this->middleware('permission:role-permission', ['only' => ['permission_index','permission_store']]);
    }
    
    public function role_assign(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            $roles = Role::whereIn('name', [$request->roles])->get();

            if ($roles->count() > 0) {
                $user->syncRoles($roles);
                Toastr::success("Role Updated Successfully.");
                return redirect()->back();
            }
        }

    }

    public function users()
    {
        $users = User::with('roles')->where('id','>',1)->get();

        $roles = Role::all();
        return view('users.index',compact('users','roles'));
    }
    public function permission_index($id)
    {
        $existing_permissions = DB::table('role_has_permissions')
        ->where('role_has_permissions.role_id', $id)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();

        $role = Role::findOrFail($id);
        $permissions = Permission::get()->groupBy('module');
        return view('permission.permission_index',compact('permissions','existing_permissions','role'));
    }

    public function permission_store(Request $request)
    {
        DB::beginTransaction();
        $role = Role::findOrFail($request->role_id);
        $role->syncPermissions($request->permissions);
        $users = User::where('role_id',$request->role_id)->get();
        foreach ($users as $key => $user) {
            $user->syncRoles([$role->name]);
        }
        DB::commit();
        Toastr::success("Permission Updated Successfully.");
        return redirect()->back();
    }


    public function index()
    {
        $roles = Role::where('id','>',1)->get();
        return view('role.role_index',compact('roles'));
    }

    public function editRole($id)
    {
        $role = Role::find($id);
        if ($role->id > 6) {
            return view('role.edit',compact('role'));
        } else {
            abort(404);
        }        
    }

    public function store(Request $request)
    {
        $find = Role::where('name', $request->role_name)->count();
        if($find == 1){
            Toastr::error("Role Exist.");
            return redirect()->back();
        }else{
            $role = Role::create(['name' => $request->role_name]);
            Toastr::success("Role Created Successfully.");
            return redirect()->back();
        }

    }

    public function updateRole(Request $request,$id)
    {
        if ($id < 7) {
            abort(404);
        } 
        $role = Role::find($id);
        $role->update(['name' => $request->role_name]);
        Toastr::success("Role Updated Successfully.");
        return redirect()->back();
    }
}
