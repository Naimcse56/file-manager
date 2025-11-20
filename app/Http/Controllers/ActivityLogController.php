<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Admin only
        $logs = ActivityLog::with('user')->latest()->get(); 
        return view('activity_logs.index', compact('logs'));
    }
}
