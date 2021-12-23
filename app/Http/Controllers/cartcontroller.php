<?php

namespace App\Http\Controllers;

use App\Models\billing_details;
use App\Models\order_details;
use App\Models\order;
use Illuminate\Http\Request;
use Cookie;
use App\Models\cart;
use App\Models\coupon;
use App\Models\product;
use Carbon\Carbon;
use PDO;
use Auth;

class cartcontroller extends Controller
{
  function addtocart(Request $request){

    if(Cookie::get('random_genarated_cart_id')){
        $random_product_id = Cookie::get('random_genarated_cart_id');
    }
    else{
        $random_product_id= rand(50000,60000).time();
     Cookie::queue('random_genarated_cart_id', $random_product_id, 500);

    }

    if(cart::where('random_genarated_cart_id', $random_product_id)->where('product_id', $request->product_id)->increment('product_quantity', $request->product_quantity)){

    }
else{
    cart::insert([
        'random_genarated_cart_id'=>$random_product_id,
        'product_id'=>$request->product_id,
        'product_quantity'=>$request->product_quantity,
        'created_at'=>carbon::now(),
       ]);
       return back();
}

  }

  function cartdelete($cart_id){
     cart::find($cart_id)->delete();
     return back();
  }

  function cart($coupon_name=''){

    if($coupon_name==''){
        $discount = 0;
    }
    else{
        if(coupon::where('coupon_name', $coupon_name)->exists()){
            if(carbon::now()->format('y-m-d') > coupon::where('coupon_name', $coupon_name)->first()->coupon_validity){
              $discount = coupon::where('coupon_name', $coupon_name)->first()->coupon_discount;
            }

            else{
              return back()->with('expired', 'coupon is expired');
            }

          }
          else{
            return back()->with('invalid_coupon', 'coupon not found');
          }
    }



  $cart_details = cart::where('random_genarated_cart_id',  cookie::get('random_genarated_cart_id'))->get();
      return view('frontend.cart', compact('cart_details','discount'));
  }

  function cartupdate(Request $request){

    foreach($request->product_quantity as $cart_id=>$product_quantity){

        cart::find($cart_id)->update([
            'product_quantity'=>$product_quantity,
         ]);
    }

    return back();


  }

  function delete($cart_id){
      cart::find($cart_id)->delete();
      return back();
  }



  function order(Request $request){



      if($request->payment_method == 1 || $request->payment_method == 2){
        $order_id=order::insertGetId([
            'user_id'=>auth::id(),
            'total'=>session('total_from_cart'),
            'discount'=>session('discount_from_cart'),
            'subtotal'=> session('total_from_cart') - session('discount_from_cart'),
            'payment_method'=>$request->payment_method,
            'created_at'=>carbon::now(),

           ]);
           billing_details::insert([
               'order_id'=>$order_id,
              'name'=>$request->name,
              'email'=>$request->email,
              'phone'=>$request->phone,
              'country_id'=>$request->country_id,
              'city_id'=>$request->city_id,
              'address'=>$request->address,
              'post_code'=>$request->post_code,
              'order_note'=>$request->order_note,
              'created_at'=>Carbon::now(),
           ]);
           $cart_details = cart::where('random_genarated_cart_id',  cookie::get('random_genarated_cart_id'))->get();


           foreach($cart_details as $cart_info){

               $product_name = product::find($cart_info->product_id)->product_name;
               $product_price = product::find($cart_info->product_id)->product_price;

               order_details::insert([
                   'order_id'=>$order_id,
                   'product_name'=>$product_name,
                   'product_price'=>$product_price,
                   'product_quantity'=>$cart_info->product_quantity,
                   'created_at'=>Carbon::now(),
               ]);



               if($request->payment_method == 1){
                cart::where('random_genarated_cart_id', cookie::get('random_genarated_cart_id'))->delete();
            }
            else{



                cart::where('random_genarated_cart_id', cookie::get('random_genarated_cart_id'))->delete();
                return redirect('/online/payment');

            }
               return redirect('/');


           }



      }


      else{
          return back()->with('payment', 'please select the payment method');
      }


}





}
