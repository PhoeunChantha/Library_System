<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        return view('index');
    }
    public function customer(){

        return view('Tables.Customers.index');
    }
}
