<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\MututalAssesment\Models\AppointmentClassification;
use Modules\MututalAssesment\Models\Rank;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-show', ['only' => ['index']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data['roles'] = Role::where('status',1)->where('id','>',1)->get(['id','name']);
        if ($request->ajax()) {
            $data = User::with(['role:id,name'])->where('id','!=',1);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function ($row) {
                    return '<div class="product-box"><img src="'.showUserAvatar($row->avatar).'"></div>';
                })
                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    return view('user.components.action', compact('row'));
                })
                ->rawColumns(['avatar','action'])
                ->make(true);
        }

        return view('user.index', $data);
        
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'mobile' => 'nullable|string|max:15|unique:users,mobile',
                'email' => 'required|email|unique:users,email',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable|string|min:6',
                'role_id' => 'nullable|integer|exists:roles,id',
            ]);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('users', 'public');
            } else {
                $photoPath = null;
            }

            DB::beginTransaction();
            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'mobile' => $validated['mobile'],
                'email' => $validated['email'],
                'avatar' => $photoPath,
                'password' => Hash::make($validated['password']),
                'role_id' => $validated['role_id'],
            ]);
            $role = Role::find($validated['role_id']);
            $user->syncRoles([$role->name]);
            DB::commit();
            Toastr::success("Added Successfully.");
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::where('status',1)->where('id','>',1)->get(['id','name']);
        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $prev_role = $user->role_id;
            $new_role = $request->role_id;
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'mobile' => 'nullable|string|max:20',
                'email' => 'required|email|max:255',
                'role_id' => 'nullable|integer',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'nullable|string|min:6',
            ]);
            $user->fill(collect($validatedData)->except(['password', 'photo', 'signature'])->toArray());
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {
                if ($user->avatar && file_exists(public_path('uploads/users/' . $user->avatar))) {
                    unlink(public_path('uploads/users/' . $user->avatar));
                }

                $photoName = time() . '_photo.' . $request->photo->extension();
                $request->photo->move(public_path('uploads/users'), $photoName);
                $user->avatar = $photoName;
            }
            $user->save();
            if ($prev_role != $new_role) {
                $role = Role::find($validatedData['role_id']);
                $user->syncRoles([$role->name]);
            }
            DB::commit();

            Toastr::success("Updated Successfully.");
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollBack();dd($e);
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        try {
            User::findOrFail($request->id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function list_for_select_ajax(Request $request)
    {
        $items = User::query();
        if ($request->search != '') {
            $items = $items->whereLike(['name','email'], $request->search);
        }
        $items = $items->where('id','>',1)->paginate(10,['id','name','email']);
        $response = [];
        foreach($items as $item){
            $name = $item->name;
            $response[]  =[
                'id'    => $item->id,
                'text'  => $name
            ];
        }
        $data['results'] =  $response;
        if ($items->count() > 0)
        {
            $data['pagination'] =  ["more" => true];
        }
        return response()->json($data);
    }
}
