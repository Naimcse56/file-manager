<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogTrait;
use DataTables;

class FileManagerController extends Controller
{
    use ActivityLogTrait;

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                if (auth()->user()->has_permit_for_all_access == 0) {
                    $data = File::with(['folder:id,name'])->whereNull('deleted_at')->where('user_id', auth()->id());
                } else {
                    $data = File::with(['folder:id,name'])->whereNull('deleted_at');
                }
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('size', function ($row) {
                        return number_format($row->size/1024,2);
                    })
                    ->editColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('action', function ($row) {
                        return view('filemanager.component.action', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('filemanager.index');
        } catch (\Exception $e) {
            Toastr::error('Unable to fetch files or folders: '.$e->getMessage());
            return back();
        }
    }

    public function file_index(Request $request)
    {
        try {
            if ($request->ajax()) {
                if (auth()->user()->has_permit_for_all_access == 0) {
                    $data = File::with(['folder:id,name'])->whereNull('deleted_at')->where('folder_id', $request->folder_id)->where('user_id', auth()->id());
                } else {
                    $data = File::with(['folder:id,name'])->whereNull('deleted_at')->where('folder_id', $request->folder_id);
                }
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('size', function ($row) {
                        return number_format($row->size/1024,2);
                    })
                    ->editColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('action', function ($row) {
                        return view('filemanager.component.action', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
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
            'file' => 'required|file|mimetypes:image/jpeg,image/png,image/webp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:20480',
            'folder_id' => 'nullable|integer|not_in:0|exists:folders,id'
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

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $file = File::find($request->id);
            if ($file->user_id !== auth()->id()) abort(403);
            
            if (Storage::exists($file->path)) {
                Storage::delete($file->path);
            }
            $file->delete();
            $this->logActivity('delete', $file, 'File moved to trash: '.$file->name);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function trash(Request $request)
    {
        try {
            if ($request->ajax()) {
                if (auth()->user()->has_permit_for_all_access == 0) {
                    $data = File::with(['folder:id,name'])->onlyTrashed()->where('user_id', auth()->id());
                } else {
                    $data = File::with(['folder:id,name'])->onlyTrashed();
                }

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('size', function ($row) {
                        return number_format($row->size/1024,2);
                    })
                    ->editColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('action', function ($row) {
                        return view('filemanager.component.trash_action', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('filemanager.trash');
        } catch (\Exception $e) {
            Toastr::error('Unable to fetch trash: '.$e->getMessage());
            return back();
        }
    }

    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $file = File::onlyTrashed()->findOrFail($request->id);
            if ($file->user_id !== auth()->id()) abort(403);

            $file->restore();
            $this->logActivity('restore', $file, 'File restored: '.$file->name);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
