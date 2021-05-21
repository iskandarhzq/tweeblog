<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        // return view('profile')->with('posts', $user->posts);
        return view('profile', ['posts' => $user->posts->sortByDesc('created_at'), 'user' => $user]);
    }

    public function update(Request $request)
    {   
        $this->validate($request, [
            'image_file' => 'nullable|image'
        ]);


        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if ($request->hasFile('image_file')){
            if ($user->image_file != 'avatar.png') {
                Storage::delete('public/image/'.$user->image_file);
            }
            $filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $imageToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image_file')->storeAs('public/image', $imageToStore);
        }

        $user->image_file = $imageToStore;
        $user->save();

        // return view('profile')->with('posts', $user->posts);
        return redirect('profile');
    }
}
