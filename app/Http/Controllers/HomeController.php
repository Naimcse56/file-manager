<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Modules\MututalAssesment\Models\SyndicateGroup;
use Illuminate\Support\Facades\Artisan;
use App\Models\File;
use App\Models\User;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:email-config', ['only' => ['email_configure_update','email_configure']]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['type_wise_count'] = File::where('user_id', auth()->id())
                        ->selectRaw("
                            CASE
                                WHEN type LIKE 'image/%' THEN 'Images'
                                WHEN type = 'application/pdf' THEN 'PDF'
                                WHEN type LIKE '%zip%' THEN 'ZIP'
                                WHEN type LIKE '%word%' THEN 'Word'
                                WHEN type LIKE '%excel%' THEN 'Excel'
                                ELSE 'Other'
                            END as category,
                            COUNT(*) as total
                        ")
                        ->groupBy('category')
                        ->get();
        $data['type_wise_size'] = File::where('user_id', auth()->id())
                        ->selectRaw("
                            type,
                            SUM(size) / 1024 / 1024 AS total_mb
                        ")
                        ->groupBy('type')
                        ->get();
        return view('home',$data);
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

    public function email_configure()
    {
        $mailConfig = [
            'MAIL_MAILER' => env('MAIL_MAILER'),
            'MAIL_SCHEME' => env('MAIL_SCHEME'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        ];
        return view('email_configure.index', compact('mailConfig'));
    }

    public function email_configure_update(Request $request)
    {
        $data = $request->only([
            'MAIL_MAILER', 'MAIL_SCHEME', 'MAIL_HOST', 'MAIL_PORT',
            'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_FROM_ADDRESS'
        ]);

        $envPath = base_path('.env');

        if (file_exists($envPath)) {
            $env = file_get_contents($envPath);

            foreach ($data as $key => $value) {
                $pattern = "/^{$key}=.*/m";
                $replacement = "{$key}={$value}";
                if (preg_match($pattern, $env)) {
                    $env = preg_replace($pattern, $replacement, $env);
                } else {
                    $env .= "\n{$replacement}";
                }
            }

            file_put_contents($envPath, $env);
        }

        // Clear config cache to apply new env values
        Artisan::call('config:clear');

        Toastr::success("Updated successfully!");
        return redirect()->route('email_configure');
    }
}
