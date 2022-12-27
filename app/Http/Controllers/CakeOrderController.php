<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CakeOrder;
use Illuminate\Http\Request;

class CakeOrderController extends Controller
{
    public function index(){
        return view('orders.index');
    }

    public function userOnly(){
        $users = CakeOrder::get();
        return view('orders.index', compact('users'));
    }

    public function showOrder($id){
        $user = User::find($id);
        return view('orders.index', compact('id', 'user'));
    }
}
