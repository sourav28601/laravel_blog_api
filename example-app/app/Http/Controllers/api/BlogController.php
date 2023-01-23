<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getall(){
        $blogs = Blog::all();
        // echo"<pre>";
        // print_r($data);
        return response()->json([
            "success" => true,
            "message" => "Blog List",
            "blogall" => $blogs
        ]);
    }
   
    public function store(Request $request){

        $blogs = Blog::create($request->all());

        return response()->json([
       "success" => true,
       "message" => "Blog created successfully.",
        "data" => $blogs
        ]);
    }

    public function show($id){
        $blog = Blog::find($id);

        return response()->json([
            "success" => true,
            "message" => "Blog detail",
             "blog" => $blog
             ]);

    }
    public function update(Request $request, $id){
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->description = $request->description;    
        $blog->save();
        return response()->json([
            "success" => true,
            "message" => "Blog update successfully",
             "blog" => $blog
             ]);


    }

    public function delete($id){
        $data = Blog::find($id);
        $data->delete();
        return response()->json([
            "success" => true,
            "message" => "Blog deleted successfully.",

             ]);
    }

}
