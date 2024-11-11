<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable=['title','slug','description','photo','status'];

    public static function getAllPost(){
        return Post::orderBy('id','DESC')->get();
    }

    public static function getPostBySlug($slug){
        return Post::where('slug',$slug)->where('status','active')->first();
    }
}
