<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::getAllPost();
        return view('backend.post.index')->with('posts',$posts);
    }

    public function create()
    {
        return view('backend.post.create');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'description'=>'string|required',
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);

        $data = $request->all();
        $descriptionPress = htmlspecialchars_decode($request->get('description'),ENT_QUOTES);
        $decodeDescriptionPress = str_replace('&nbsp;', ' ',$descriptionPress);
        $data['description'] = $decodeDescriptionPress;
        $slug=Str::slug($request->title);
        $count=Post::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        // return $data;

        $status=Post::create($data);
        if($status){
            request()->session()->flash('success','Post Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('post.index');
    }

    public function edit($id)
    {
        $post=Post::findOrFail($id);
        return view('backend.post.edit')->with('post',$post);
    }

    public function update(Request $request, $id)
    {
        $post=Post::findOrFail($id);
         // return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            'description'=>'string|required',
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);

        $data=$request->all();

        $descriptionPress = htmlspecialchars_decode($request->get('description'),ENT_QUOTES);
        $decodeDescriptionPress = str_replace('&nbsp;', ' ',$descriptionPress);
        $data['description'] = $decodeDescriptionPress;

        $status=$post->fill($data)->save();
        if($status){
            request()->session()->flash('success','Post Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $post=Post::findOrFail($id);

        $status=$post->delete();

        if($status){
            request()->session()->flash('success','Post successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting post ');
        }
        return redirect()->route('post.index');
    }
}
