<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //

    public function allCat() {
        $categories = category::latest()->paginate(5);
        // $categories = DB::table("categories")->join('users', "categories.user_id", "users.id")->select("categories.*", "users.name")->latest()->paginate(5);
        //$categories = DB::table("categories")->latest()->paginate(5);
        return view("admin.category.index", compact('categories'));
    }

    public function storeCategory(Request $request) {
        $validateData  = $request->validate([
            "category_name" => "required|unique:categories|max:255|max:255"
        ],
        [
            "category_name.required" => "Please input category name"
        ]
    
    );
    // category::insert([
    //     "category_name" => $request->category_name,
    //     "user_id" => Auth::user()->id,
    //     "created_at" => Carbon::now()
    // ]);

    // $category = new category;
    // $category->category_name = $request->category_name;
    // $category->user_id = Auth::user()->id;
    // $category->save();

    $data = array();
    $data['category_name'] = $request->category_name;
    $data['user_id'] = Auth::user()->id;
    $data['created_at'] = Carbon::now();
    DB::table("categories")->insert($data);

        return redirect()->back()->with("success", "Category Inserted Successfully");
    }

    public function editCategory($id) {
        $category = category::find($id);
        return view("admin.category.edit", compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        // $update = category::find($id)->update([
        //     "category_name" => $request->category_name,
        //     "user_id" => Auth::user()->id
        // ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table("categories")->where("id",$id)->update($data);

        return redirect()->route("all.category")->with("success", "category updates successfully");
    }
}
