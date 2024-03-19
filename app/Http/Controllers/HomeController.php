<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
Use \Carbon\Carbon;
use App\Models\category;
use App\Models\saleLaravel;
use App\Models\supplier;
use App\Models\product;
use App\Models\purchase;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype==1){

            
            $total_purchases = Purchase::where('expiry_date','!=',Carbon::now())->count();
            $total_categories = Category::count();
            $total_suppliers = Supplier::count();
            $total_sales = SaleLaravel::count();
            
            
            $total_expired_products = Purchase::whereDate('expiry_date', '=', Carbon::now())->count();
            $latest_sales = SaleLaravel::whereDate('created_at','=',Carbon::now())->get();
            $today_sales = SaleLaravel::whereDate('created_at','=',Carbon::now())->sum('total_price');
            return view('admin.home',compact(
                'total_expired_products',
                'today_sales','total_categories','total_suppliers'
            ));
        }
            
        else{
            return view('home.userpage');
        }

    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
