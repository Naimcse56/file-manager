<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
