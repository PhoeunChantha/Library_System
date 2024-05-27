<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Customer;
use App\Models\Librarian;
use App\Models\BorrowDetail;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $books = Book::with('catalog')->get();
        return view('Backends.index',compact(
            'totalBorrows',
            'borrows',
            'totalReturns',
            'totalBooks',
            'totalLibrarians',
            'totalCustomers','totalUsers','books'));
    }
}
