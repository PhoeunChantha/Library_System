<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowDetailController extends Controller
{
    public function index(){
        return view('Tables.Books.index');
    }
    public function create(){
        return view('Tables.Books.create');
    }
    public function store(){

    }
    public function edit(){
        return view('Tables.Books.edit');
    }
    public function update(){

    }
    public function destroy(){

    }
}
