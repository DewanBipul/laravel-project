<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use PDF;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $users= user::WHERE('id', '!=', $user_id)->orderBy('id', 'asc')->simplePaginate(2);
        $total_user = user::count();
        $logged_user = Auth::user()->name;

        $order_details = order::where('user_id', auth::id())->get();


        return view('/home', compact('users', 'total_user', 'logged_user', 'order_details'));
    }

    function insert(Request $request){

        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'roll'=>$request->roll,
            'created_at'=>Carbon::now(),


        ]);

        return back();




    }





function invoicedwonload($order_id){
    $data = order::find($order_id);
    $pdf = PDF::loadView('frontend.pdf.invoice', compact('data'));
    return $pdf->stream('invoice.pdf');

}


function search(){
    $q= $_GET['q'];
    $search_by = $_GET['search_by'];


    if($search_by == 1){

        $search_product= product::where('product_name', 'like','%'.$q.'%')->orderBy('product_name', 'asc')->get();
    }
    else{

        $search_product= product::where('product_name', 'like','%'.$q.'%')->orderBy('product_name', 'desc')->get();

    }

    return view('frontend.search', compact('search_product'));
}



}

