<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogTrait;

class FileManagerController extends Controller
{
    use ActivityLogTrait;

    public function index()
    {
        try {
            $files = File::whereNull('deleted_at')->where('user_id', auth()->id())->get();
            $folders = Folder::where('user_id', auth()->id())->get();
            return view('filemanager.index', compact('files','folders'));
        } catch (\Exception $e) {
            Toastr::error('Unable to fetch files or folders: '.$e->getMessage());
            return back();
        }
    }

    public function uploadPage()
    {
        try {
            $folders = Folder::where('user_id', auth()->id())->get();
            return view('filemanager.upload', compact('folders'));
        } catch (\Exception $e) {
            Toastr::error('Unable to fetch folders: '.$e->getMessage());
            return back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480',
            'folder_id' => 'nullable|exists:folders,id'
        ]);

        DB::beginTransaction();

        try {
            $uploaded = $request->file('file');
            $path = $uploaded->store('files/' . auth()->id());

            $file = File::create([
                'folder_id' => $request->folder_id,
                'user_id' => auth()->id(),
                'name' => $uploaded->getClientOriginalName(),
                'type' => $uploaded->getMimeType(),
                'size' => $uploaded->getSize(),
                'path' => $path,
                'is_private' => true,
            ]);

            $this->logActivity('upload', $file, 'File uploaded: '.$file->name);

            DB::commit();
            Toastr::success('File uploaded successfully');
            return redirect()->route('file-manager.index');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($path) && Storage::exists($path)) {
                Storage::delete($path); // Cleanup if file was saved
            }
            Toastr::error('File upload failed: '.$e->getMessage());
            return back();
        }
    }

    public function download(File $file)
    {
        try {
            if ($file->user_id !== auth()->id()) abort(403);
            if (!Storage::exists($file->path)) abort(404);
            return Storage::download($file->path, $file->name);
        } catch (\Exception $e) {
            Toastr::error('Download failed: '.$e->getMessage());
            return back();
        }
    }

    public function destroy(File $file)
    {
        DB::beginTransaction();
        try {
            if ($file->user_id !== auth()->id()) abort(403);

            $file->delete();
            $this->logActivity('delete', $file, 'File moved to trash: '.$file->name);

            DB::commit();
            Toastr::success('File moved to trash');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('File delete failed: '.$e->getMessage());
            return back();
        }
    }

    public function trash()
    {
        try {
            $files = File::onlyTrashed()->where('user_id', auth()->id())->get();
            return view('filemanager.trash', compact('files'));
        } catch (\Exception $e) {
            Toastr::error('Unable to fetch trash: '.$e->getMessage());
            return back();
        }
    }

    public function restore($id)
    {
        DB::beginTransaction();
        try {
            $file = File::onlyTrashed()->findOrFail($id);
            if ($file->user_id !== auth()->id()) abort(403);

            $file->restore();
            $this->logActivity('restore', $file, 'File restored: '.$file->name);

            DB::commit();
            Toastr::success('File restored successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('File restore failed: '.$e->getMessage());
            return back();
        }
    }
}
