<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //direct category
    public function list(
    ){
        return view('admin.category.list');
    }
}