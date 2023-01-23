<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        $categories = Category::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "Category created successfully.",
             "data" => $categories
        ]);

    }
    public function displayall(){
        $categories = Category::all();
        // echo"<pre>";
        // print_r($data);
        return response()->json([
            "success" => true,
            "message" => "Category list",
            "data" =>  $categories 

        ]);
    }
    public function show($id){
        $categories = Category::find($id);

        return response()->json([
            "success" => true,
            "message" => "Category detail",
                "blog" =>  $categories
                ]);

    }
    public function update(Request $request, $id){
        $categories = Category::find($id);
        $categories ->title = $request->title;
        $categories ->save();
        return response()->json([
            "success" => true,
            "message" => "Category update successfully",
             "blog" => $categories 
        ]);
    }

    public function delete($id){
        $data = Category::find($id);
        $data->delete();
        return response()->json([
            "success" => true,
            "message" => "Category deleted successfully.",

        ]);
    }
 
}
