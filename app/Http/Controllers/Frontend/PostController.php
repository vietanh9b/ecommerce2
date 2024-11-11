<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{

    /**
     * Show listing on the frontend.
     *
     * @return Application|Factory|View
     */
    public function listing()
    {
        $posts = Post::where('status','active')->paginate(3);
        return view('frontend.pages.blog')->with('posts' , $posts);
    }

    /**
     * Show detail blog by slug.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function index($slug)
    {
        $post = Post::getPostBySlug($slug);

        return view('frontend.pages.blog-detail')->with('post', $post);
    }

}
