<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\country;
use App\Models\city;
use App\Models\product;
use  Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
  function welcome(){
      $category = category::all();
      $products = product::all();
      return view('frontend.index', compact('category','products'));
  }

  function product_details($product_id){
      $product_info = product::find($product_id);
      $category_id = product::find($product_id)->category_id;
      $related_product = product::where('category_id', $category_id)->where('id', '!=', $product_id)->get();
      return view('frontend.details', compact('product_info', 'related_product'));

  }

  function singleview($product_id){
      return view('frontend.single_views');

  }

  function shop(){
      $categories= category::all();
      $products = product::all();
      return view('frontend.shop', compact('categories','products'));
  }

  function product_list($product_id){

    $category_products = product::where('id', $product_id)->get();
    $category_name = product::find($product_id)->product_name;
    return view('frontend.category_product', compact('category_products', 'category_name'));

  }


  function checkout(){
      $countries = country::select('name', 'id')->get();

    return view('frontend.checkout', compact('countries'));
}

function getcitylist(Request $request){
    $cities = city::where('country_id', $request->country_id)->get();
      $str_to_send  = "<option value=''>--select country--</option>";

      foreach($cities as $cityname){
        $str_to_send .="<option value='".$cityname->id."'>".$cityname->name."</option>";
      }

      echo $str_to_send;

}


}


