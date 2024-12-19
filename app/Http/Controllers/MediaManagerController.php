<?php

namespace App\Http\Controllers;

use App\Models\MediaManager;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class MediaManagerController extends Controller
{
    # get media files
    public function index(Request $request)
    {
        $searchKey  = null;
        $type       = null;

        $mediaFiles = MediaManager::query()->latest();
       
        // if (Auth::user()->user_type != 'admin') {
        //     $mediaFiles = $mediaFiles->where('user_id', Auth::user()->id);
        // }

        if ($request->type != 'all') {
            $mediaFiles = $mediaFiles->where('media_type', $type);
        }

        $recentFiles = $mediaFiles->take(6)->get();
        $recentFileIds = $recentFiles->pluck('id');

        if ($request->searchKey != null) {          
            $searchKey = $request->searchKey;
            $mediaFiles = $mediaFiles->where('media_name', 'like', '%' . $request->searchKey . '%');
        }
        $mediaFiles  = $mediaFiles->whereNotIn('id', $recentFileIds)->paginate(paginationNumber(20))->appends(request()->query());
        // $mediaFiles  = $mediaFiles->whereNotIn('id', $recentFileIds)->paginate(paginationNumber(30))->appends(request()->query());

        return [
            'status' => true,
            'recentFiles' => view('backend.mediamanager.partials.recent', compact('recentFiles'))->render(),
            'mediaFiles' => view('backend.mediamanager.partials.previous', compact('mediaFiles'))->render(),
            'mediaQuery' => $mediaFiles
        ];
    }

    # get selected media files
    public function selectedFiles(Request $request)
    {
        $mediaFiles = MediaManager::whereIn('id', $request->mediaIds)->get();
        return [
            'status' => true,
            'mediaFiles' => view('backend.mediamanager.partials.image', compact('mediaFiles'))->render()
        ];
    }

    # store media file to media manager
    public function store(Request $request)
    {
        try {
            if ($request->file('file')) {
                    
                $mediaFile = new MediaManager;                    
                $mediaFile->user_id = Auth::user()->id;

                // $mediaFile->media_file = $request->file('file')->store('media');   

                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();
                $mediaFile->media_file = $request->file->storeAs('media', $filename, 'public');
                
                $mediaFile->media_size = $request->file('file')->getSize();                    
                $mediaFile->media_name = $request->file('file')->getClientOriginalName();                    
                $mediaFile->media_extension = $request->file('file')->getClientOriginalExtension();        
                if (getFileType(Str::lower($mediaFile->media_extension)) != null) {
                    $mediaFile->media_type = getFileType(Str::lower($mediaFile->media_extension));
                } 
                else {
                    $mediaFile->media_type = "unknown";
                }
                // $mediaFile->media_type = "image";

                $mediaFile->save();                        
                // return response()->json($form);
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }        
    }

    # delete media
    public function delete($id)
    {
        $mediaFile = MediaManager::findOrFail($id);
        if (!is_null($mediaFile)) {
            fileDelete($mediaFile->media_file);
            # todo:: check auth user, media user -- 
            $mediaFile->delete();
        }

        // flash('File has been deleted successfully')->success(); 
        // return redirect()->route('admin.mediaManager.index');
        return redirect()->back()->with('message', 'File has been deleted successfully!');

    }
}
