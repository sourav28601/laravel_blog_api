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

        $file =$request->file('image');
        $filename = 'image'. time().'.'.$request->image->extension();
        $file->move("upload/",$filename);

        $blogs = Blog::create($request->only(['title','description'])+[
            'image'=>$filename
        ]);

        
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
       
        $validated = $request->validate([
            'title' => 'required|sometimes',
            'description' => 'required|sometimes',
        ]);
        $blog = new Blog();
        $blog = Blog::find($id);
        if($request->file('image')){
            $file =$request->file('image');
            $filename = 'image'. time().'.'.$request->image->extension();   
            $file->move("upload/",$filename);
            $blog->image = $filename;
        }
       

       
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
