<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Dotenv\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else{
            $post = new Post();
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->user_id = 1;
            $post->body = $request->body;
            $post->slug = strtolower($request->title);
            $post->save();
            return response()->json([
                'status' => 200,
                'message' => 'Post added successfully',
            ]);
        }
    }

    public function view(Post $post){
        $categories = Category::all();
        return view('blog.singlePost',compact('post','categories'));
    }
    public function edit($slug){
        $post = Post::where('slug','=',$slug)->first();
        return json_encode($post);
    }

    public function update(Request $request,$slug){
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $post = Post::where('slug','=',$slug)->first();
            $post->title = ucwords($request->title);
            $post->category_id = $request->category_id;
            $post->user_id = 1;
            $post->body = $request->body;
            $post->slug = $slug;
            $post->save();
            return response()->json([
                'status' => 200,
                'message' => 'Post updated successfully',
            ]);
        }



    }

    public function delete($slug){
        $post = Post::where('slug','=',$slug)->first();
        $post->delete();
    }

}
