<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogTrait;

class FolderController extends Controller
{
    use ActivityLogTrait;

    public function index()
    {
        try {
            $folders = Folder::where('user_id', auth()->id())->get();
            return view('folder.index', compact('folders'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to fetch folders: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:200']);

        DB::beginTransaction();

        try {
            $folder = Folder::create([
                'name' => $request->name,
                'user_id' => auth()->id(),
                'path' => '/folder/' . $request->name,
            ]);

            $this->logActivity('create', $folder, 'Folder created: ' . $folder->name);

            DB::commit();
            return back()->with('success', 'Folder created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Folder creation failed: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Folder $folder)
    {
        if ($folder->user_id !== auth()->id()) abort(403);

        $request->validate(['name' => 'required|string|max:200']);

        DB::beginTransaction();

        try {
            $folder->update(['name' => $request->name]);

            $this->logActivity('update', $folder, 'Folder updated: ' . $folder->name);

            DB::commit();
            return back()->with('success', 'Folder updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Folder update failed: ' . $e->getMessage());
        }
    }

    public function destroy(Folder $folder)
    {
        if ($folder->user_id !== auth()->id()) abort(403);

        DB::beginTransaction();

        try {
            $folder->delete();

            $this->logActivity('delete', $folder, 'Folder deleted: ' . $folder->name);

            DB::commit();
            return back()->with('success', 'Folder deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Folder deletion failed: ' . $e->getMessage());
        }
    }
}
