<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use DataTables;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:activity-logs', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ActivityLog::with('user')->latest();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    return ucfirst($row->action);
                })
                ->editColumn('target_type', function ($row) {
                    return class_basename($row->target_type).' #'.$row->target_id ?? '-';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d-M-Y H:i');
                })
                ->rawColumns(['avatar','action'])
                ->make(true);
        }
        return view('activity_logs.index');
    }
}
