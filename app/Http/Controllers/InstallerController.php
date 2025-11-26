<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InstallerController extends Controller
{
    public function first_step()
    {
        return view('install.first_step');
    }

    public function second_step()
    {
        return view('install.second_step');
    }

    public function third_step(Request $request)
    {
        $request->validate([
            "APP_NAME"     => "required|string",
            "DB_CONNECTION"=> "required|string",
            "DB_HOST"      => "required|string",
            "DB_PORT"      => "required|string",
            "DB_DATABASE"  => "required|string",
            "DB_USERNAME"  => "required|string",
            "DB_PASSWORD"  => "nullable|string",
        ]);

        // Data collect
        $data = [
            'APP_NAME'      => $request->APP_NAME,
            'DB_CONNECTION' => $request->DB_CONNECTION,
            'DB_HOST'       => $request->DB_HOST,
            'DB_PORT'       => $request->DB_PORT,
            'DB_DATABASE'   => $request->DB_DATABASE,
            'DB_USERNAME'   => $request->DB_USERNAME,
            'DB_PASSWORD'   => $request->DB_PASSWORD,
        ];

        // Write to .env
        $this->updateEnv($data);
        \Artisan::call('key:generate', ['--force' => true]);
        Toastr::success('Setup successfully');
        return redirect()->route('install.fourth_step');
    }

    public function fourth_step()
    {
        try {
            \Artisan::call('migrate', ['--force' => true]);
            \Artisan::call('db:seed', ['--force' => true]);
            return view('install.fourth_step');
        } catch (\Exception $e) {dd($e->getMessage());
            Toastr::error('Migration failed: '.$e->getMessage());
            return back();
        }
    }

    protected function updateEnv($data = [])
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $env = file_get_contents($path);

            foreach ($data as $key => $value) {
                $value = '"' . $value . '"';
                $pattern = '/^' . $key . '=.*/m';

                if (preg_match($pattern, $env)) {
                    $env = preg_replace($pattern, $key . '=' . $value, $env);
                } else {
                    $env .= "\n" . $key . '=' . $value;
                }
            }

            file_put_contents($path, $env);
        }
    }

    public function fifth_step(Request $request)
    {
        $request->validate([
            "name"              => "required|string|max:255",
            "email"             => "required|email|max:255|unique:users,email",
            "password"          => "required|min:6",
            "confirm_password"  => "required|same:password",
        ]);

        // Create admin user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'password_changed_for_first_time' => 1,
            'has_permit_for_all_access' => 1,
            'status' => 1,
            'role_id' => 1,
        ]);
        $role = Role::first();
        $user->syncRoles([$role->name]);
        file_put_contents(storage_path('installed'), 'installed');

        $status = [
            'installed' => true,
            'installed_at' => now()->toDateTimeString(),
        ];

        // Ensure folder exists
        $statusFolder = storage_path('app/public');
        if (!file_exists($statusFolder)) {
            mkdir($statusFolder, 0755, true);
        }

        file_put_contents($statusFolder . '/installed_status.json', json_encode($status, JSON_PRETTY_PRINT));

        Toastr::success('Setup successfully. Login Now.');
        return redirect()->route('login');
    }

}
