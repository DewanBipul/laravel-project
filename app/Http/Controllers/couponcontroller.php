<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;


class couponcontroller extends Controller
{
    function couponcart(){
        $coupon = coupon::all();
        return view('admin.coupon.index', compact('coupon'));
    }

    function insert(Request  $request){
        coupon::insert($request->except('_token')+[
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('coupon', 'coupon added!');
    }
}
