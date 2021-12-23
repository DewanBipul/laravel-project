<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\subcategory;
use App\Models\thumbnail;
use Illuminate\Http\Request;
use carbon\Carbon;
use Auth;
use Image;


class productcontroller extends Controller
{
   function list(){
       $categories = category::all();
       $subcategories = subcategory::all();
       $product_info = product::all();
    return view('admin.product.index', compact('categories', 'subcategories', 'product_info'));


   }

   function insert(Request $request){

       $product_id = product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_desp'=>$request->product_desp,
            'product_quantity'=>$request->product_quantity,
            'product_photo'=>$request->product_photo,
            'created_at'=>carbon::now(),

        ]);


        $uploaded_photo = $request->product_photo;
        $extension = $uploaded_photo->getClientOriginalExtension();
        $new_photo_name = $product_id.'.'.$extension;

        Image::make($uploaded_photo)->save(base_path('public/uploads/product/'.$new_photo_name));

        product::find($product_id)->update([
            'product_photo'=>$new_photo_name,
        ]);



        $start = 1;

        foreach($request->file('product_thumbnails') as $single_img){
            $extension = $single_img->getClientOriginalExtension();
            $new_product_thumbnail_img= $product_id.'-'.$start.'.'.$extension;
            Image::make($single_img)->save(base_path('public/uploads/product/thumbnail/'.$new_product_thumbnail_img));

        thumbnail::insert([
            'product_id'=>$product_id,
            'thumbnail'=>$new_product_thumbnail_img,
            'created_at'=>Carbon::now(),
        ]);
            $start++;
        }


        return back()->with('product', 'your information successfully added');




   }

   function edit($id){

    $product_details= product::find($id);
    $category_info = category::all();
    $subcategory_info = subcategory::all();
       return view('admin.product.edit', compact('product_details','category_info','subcategory_info'));
   }

   function update (Request $request){

            if($request->product_photo == ''){

             product::find ($request->product_info)->update([
               'category_id'=>$request->category_id,
                  'subcategory_id'=>$request->subcategory_id,
                       'product_name'=>$request->product_name,
                    'product_price'=>$request->product_price,
                'product_desp'=>$request->product_desp,
            'product_quantity'=>$request->product_quantity,

  ]);

}
else{
    product::find($request->product_info)->update([
        'category_id'=>$request->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'product_name'=>$request->product_name,
        'product_price'=>$request->product_price,
        'product_desp'=>$request->product_desp,
        'product_quantity'=>$request->product_quantity,

  ]);

  $uploaded_product_img = $request->product_photo;
  $extension = $uploaded_product_img->getClientOriginalExtension();
  $new_image_name=  $request->product_info.'.'.$extension;

  Image::make($uploaded_product_img)->save(base_path('public/uploads/product/'.$new_image_name));

product::find($request->product_info)->update([
    'product_photo'=>$new_image_name,
]);

return back()->with('success', 'your information update successfully done');



}

}
function delete($id){
    product::find($id)->delete();
    return back();
}




}
