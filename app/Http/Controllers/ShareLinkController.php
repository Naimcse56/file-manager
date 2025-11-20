<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\ShareLink;
use App\Traits\ActivityLogTrait;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShareLinkController extends Controller
{
    use ActivityLogTrait;

    // List all share links for current user
    public function index()
    {
        try {
            $links = ShareLink::where('user_id', auth()->id())->with('file')->get();
            $files = File::where('user_id', auth()->id())->get();
            return view('sharelinks.index', compact('links', 'files'));
        } catch (\Exception $e) {
            Toastr::error('Unable to fetch share links: '.$e->getMessage());
            return back();
        }
    }

    // Create new share link
    public function store(Request $request, File $file)
    {
        $request->validate([
            'password' => 'nullable|string|max:50',
            'expires_at' => 'nullable|date|after:now',
        ]);

        if ($file->user_id !== auth()->id()) {
            Toastr::error('Unauthorized access.');
            return back();
        }

        DB::beginTransaction();
        try {
            $token = Str::random(32);

            $share = ShareLink::create([
                'user_id' => auth()->id(),
                'file_id' => $file->id,
                'token' => $token,
                'password' => $request->password ? bcrypt($request->password) : null,
                'expires_at' => $request->expires_at,
                'can_download' => true,
            ]);

            $this->logActivity('share', $file, 'File shared: '.$file->name);

            DB::commit();
            Toastr::success('Shareable link created successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Failed to create share link: '.$e->getMessage());
            return back();
        }
    }

    // Access a shared file
    public function view($token)
    {
        try {
            $link = ShareLink::where('token', $token)->with('file')->firstOrFail();

            if ($link->expires_at && Carbon::now()->greaterThan($link->expires_at)) {
                Toastr::error('This link has expired.');
                return redirect()->route('file-manager.index');
            }

            if ($link->password && !session()->has("share_link_access_$token")) {
                return view('sharelinks.password', compact('token'));
            }

            if (!Storage::exists($link->file->path)) {
                Toastr::error('File not found on server.');
                return redirect()->route('file-manager.index');
            }

            if ($link->can_download) {
                return Storage::download($link->file->path, $link->file->name);
            } else {
                Toastr::info('File download is disabled for this link.');
                return redirect()->route('file-manager.index');
            }

        } catch (\Exception $e) {
            Toastr::error('Invalid link: '.$e->getMessage());
            return redirect()->route('file-manager.index');
        }
    }

    // Verify password
    public function verifyPassword(Request $request, $token)
    {
        $request->validate(['password' => 'required|string']);

        try {
            $link = ShareLink::where('token', $token)->firstOrFail();

            if (!$link->password || !\Hash::check($request->password, $link->password)) {
                Toastr::error('Incorrect password.');
                return back();
            }

            session(["share_link_access_$token" => true]);
            Toastr::success('Password verified.');
            return redirect()->route('share-links.view', $token);

        } catch (\Exception $e) {
            Toastr::error('Error verifying password: '.$e->getMessage());
            return back();
        }
    }

    // Revoke share link
    public function destroy(ShareLink $share)
    {
        if ($share->user_id !== auth()->id()) abort(403);

        DB::beginTransaction();
        try {
            $share->delete();
            $this->logActivity('delete', $share, 'Share link revoked for file: '.$share->file->name);
            DB::commit();
            Toastr::success('Share link revoked successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Failed to revoke share link: '.$e->getMessage());
            return back();
        }
    }
}
