<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogTrait;
use Brian2694\Toastr\Facades\Toastr;

class FolderController extends Controller
{
    use ActivityLogTrait;

    public function index(Request $request)
    {
        try {
            $folders = Folder::query();
            if ($request->search) {
                $folders = $folders->where('name', 'LIKE', "%$request->search%");
            }
            if (auth()->user()->has_permit_for_all_access == 1) {
                $folders = $folders->whereNull('parent_id')->get();
            } else {
                $folders = $folders->whereNull('parent_id')->where('user_id', auth()->id())->get();
            }
            return view('folder.index', compact('folders'));
        } catch (\Exception $e) {
            Toastr::error('Unable to fetch folders: ' . $e->getMessage());
            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate(['name' => 'required|string|max:200','parent_id' => 'nullable|integer']);
            DB::beginTransaction();
            $folder = Folder::create([
                'parent_id' => $request->parent_id > 0 ? $request->parent_id : null,
                'name' => $request->name,
                'user_id' => auth()->id(),
                'path' => '/folder/' . $request->name,
            ]);

            $this->logActivity('create', $folder, 'Folder created: ' . $folder->name);

            DB::commit();
            Toastr::success('Folder created successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Folder creation failed: ' . $e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $folder = Folder::find($id);
        if ($folder->user_id !== auth()->id()) abort(403);

        return view('folder.edit', compact('folder'));
    }

    public function show($id)
    {
        $detailFolder = Folder::find($id);
        if ($detailFolder->user_id !== auth()->id()) abort(403);

        return view('folder.show', compact('detailFolder'));
    }

    public function show_files($id)
    {
        $detailFolder = Folder::find($id);
        if ($detailFolder->user_id !== auth()->id()) abort(403);

        return view('folder.show_files', compact('detailFolder'));
    }

    public function update(Request $request, Folder $folder)
    {
        if ($folder->user_id !== auth()->id()) abort(403);

        try {
            $request->validate(['name' => 'required|string|max:200','parent_id' => 'nullable|integer']);
            DB::beginTransaction();
            $folder->update(['name' => $request->name,'parent_id' => $request->parent_id > 0 ? $request->parent_id : null]);

            $this->logActivity('update', $folder, 'Folder updated: ' . $folder->name);

            DB::commit();
            Toastr::success('Folder updated successfully');
            return redirect()->route('folder.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Folder update failed: ' . $e->getMessage());
            return back();
        }
    }

    public function destroy(Request $request)
    {
        $folder = Folder::find($request->id);
        if ($folder->user_id !== auth()->id()) abort(403);
        
        try {
            DB::beginTransaction();
            $folder->delete();

            $this->logActivity('delete', $folder, 'Folder deleted: ' . $folder->name);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function list_for_select_ajax(Request $request)
    {
        $items = Folder::query();
        if ($request->search != '') {
            $items = $items->whereLike(['name'], $request->search);
        }
        
        if (auth()->user()->has_permit_for_all_access == 0) {
            $items = $items->where('user_id', auth()->id());
        }
        $items = $items->paginate(10,['id','name']);
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
