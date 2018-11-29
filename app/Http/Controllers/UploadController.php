<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Tag;


class UploadController extends Controller
{
    public function __construct()
    {

    }
    public function index(){
        $data = Image::with('tags')->get();
        return view('index', compact('data'));

    }
    public function doSearch(Request $request){

        $search_key = $request->get('keywords');
        $data = Image::whereHas('tags', function ($query) use($search_key){
            $query->where('tag', 'like', '%'.$search_key.'%');
        })->get();
        $view = view("ajax",compact('data'))->render();
        return response()->json(['html'=>$view]);

    }
    public function doUpload(Request $request){
       // dd($request->image->path());
    	$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required'
        ]);
        $imageName = time().'.'.$request->image->getClientOriginalExtension();

        if(request()->image->move(public_path('images'), $imageName)){
            $image = new Image;
            $image->title = $request->get('title');
            $image->filename = $imageName;
            $image->save();
            $image_tags = $request->get('tag');
            $image->save();
            //$tag = new Tag;
            // $tag->images = new Image();

            foreach($image_tags as $tag){
                $tag = new Tag(['tag' => $tag]);
                $image->tags()->save($tag);
            }
        	return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
        }else{
        	return back()
            ->with('error','Oppsss an error occured uploading the image')
            ->with('image',$imageName);
        }


    }
}
