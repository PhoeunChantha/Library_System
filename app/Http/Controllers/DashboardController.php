<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Customer;
use App\Models\Librarian;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $borrows = Borrow::all();
        $totalBorrows = count($borrows);
        $totalReturns = BorrowDetail::where('IsReturn', 1)->count();
        $books = Book::all();
        $totalBooks = count($books);
        $librarians = Librarian::all();
        $totalLibrarians = count($librarians);
        $customers = Customer::all();
        $totalCustomers = count($customers);
        $users = User::all();
        $totalUsers = count($users);
        return view('index',compact(
            'totalBorrows',
            'borrows',
            'totalReturns',
            'totalBooks',
            'totalLibrarians',
            'totalCustomers','totalUsers'));
    }

    public function customer(){

        return view('Tables.Customers.index');
    }
}
