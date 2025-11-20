<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Modules\MututalAssesment\Models\SyndicateGroup;
use Modules\MututalAssesment\Models\AcademicEvent;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','check_password_changed']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user'] = auth()->user();
        if (in_array($data['user']->role_id, [4,5])) {
            return view('mututalassesment::dashboard_ds', $data);
        } elseif (in_array($data['user']->role_id, [6])) {
            return view('mututalassesment::dashboard_cp', $data);
        } else {
            $data['local_cp'] = User::whereIn('country_id',[0,19])->where('appointment_classification_id', 7)->count();
            $data['foreign_cp'] = User::whereNotIn('country_id',[0,19])->where('appointment_classification_id', 7)->count();
            $data['total_group'] = SyndicateGroup::count();
            $data['total_event'] = AcademicEvent::count();
            return view('mututalassesment::dashboard_admin', $data);
            // return view('home');
        }
    }

    public function change_password()
    {
        return view('user.change_password');
    }

    public function update_change_password(Request $request)
    {
        try {
            $request->validate([
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
                ],
            ], [
                'new_password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ]);
            
            $user = auth()->user();
            if (!Hash::check($request->current_password, $user->password)) {
                Toastr::error("The password you entered is incorrect!");
                return back();
            }
            $user->password = Hash::make($request->new_password);
            $user->password_changed_for_first_time = 1;
            $user->save();
            
            Toastr::success("Password changed successfully!");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
}
