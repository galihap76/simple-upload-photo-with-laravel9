<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = DB::select('select image from gallery where id = ?', [8]);
        return view('imageUpload', ['images' => $gallery]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finder = new Finder();
        $finder->in('images');

        $request->validate([
            'image' => 'required|image|mimes:png,jpeg|max:2048'
        ]);

        $imageName = $request->file('image')->getClientOriginalName();

        if (File::exists(public_path('images/' . $imageName))) {
            Session::flash('message', 'The photo already upload.');
            return Redirect::to('image-upload');
        }

        foreach ($finder as $file) {
            $publicFile = $file->getFilename();

            if (File::exists(public_path('images/' . $publicFile))) {
                File::delete(public_path('images/' . $publicFile));
                $request->image->move(public_path('images'), $imageName);

                DB::table('gallery')
                    ->where('id', 8)
                    ->update(['image' => $imageName]);

                Session::flash('messageSuccess', 'The photo has been successfully uploaded.');
                return Redirect::to('image-upload');
            }
        }
    }
}
