<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Auth;
use carbon\Carbon;

use App\Http\Requests\categorypost;
use App\Models\subcategory;

class categorycontroller extends Controller
{
    function index(){
      $categories = category::Latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    function insert(categorypost $request){

        //insert category
        category::insert([

            'category_name'=>$request->category_name,
            'added_by'=>auth()->id(),
            'created_at'=> carbon::now(),
        ]);

        return back()->with('success', 'category successfully added');
    }

    function delete($category_id){
      category::find($category_id)->delete();
        subcategory::where('category_id', $category_id)->update([
            'category_id'=>1,
        ]);
      return back()->with('delsuccess', 'category successfully deleted');
    }
}
