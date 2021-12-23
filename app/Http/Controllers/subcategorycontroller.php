<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\subcategorypost;
use Carbon\Carbon;




use PDO;

class subcategorycontroller extends Controller
{
    function index(){
        $subcategories= subcategory::Latest()->get();
        $categories= category::all();
        $deleted_subcategory= subcategory::onlyTrashed()->get();
        return view('admin.subcategory.index', compact('categories', 'subcategories', 'deleted_subcategory'));
    }


    function insert(subcategorypost $request){

        if(subcategory::withTrashed()->where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()){
            return back()->with('subcategorymsg', 'the subcategory already exist');
        }

        subcategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'created_at'=>carbon::now(),

        ]);
        return back()->with('success', 'your subcategory successfully updated');

    }

function delete($subcategory_id){
    subcategory::find($subcategory_id)->delete();
    return back();
}

function restore($undo){

    subcategory::withTrashed()->find($undo)->restore();

    return back();
}

function perdelete($permanent){

    subcategory::withTrashed()->find($permanent)->forceDelete();
    return back()->with('perdelete', 'subcategory successfully deleted');
}

function markdelete(Request $request){

 if($request->marked_delete){
     foreach($request->marked_delete as $single_delete){
         subcategory::find($single_delete)->delete();

     }
 }

 return back();

}

function markall(Request $request){
  if($request->trashdelete){
    if($request->markdelete){
       foreach($request->markdelete as $fdelete){
        subcategory::withTrashed()->find($fdelete)->forceDelete();

       }
    }
   return back();
  }

  else{
      if($request->markrestore){
        if($request->markdelete){
         foreach($request->markdelete as $trashrestore){
             subcategory::withTrashed()->find($trashrestore)->restore();
         }
         return back();

        }
      }
  }


}

function edit($subcategory_id){
    $subcategories = subcategory::find($subcategory_id);
    $categories = category::all();
    return view('admin.subcategory.edit', compact('subcategories', 'categories'));
}

  function update(Request $request){

    subcategory::find($request->subcategory_id)->update([
        'category_id'=>$request->category_id,
        'subcategory_name'=>$request->subcategory_name,
    ]);

    return back()->with('subsuccess',  'your information successfully updated');

  }

}
