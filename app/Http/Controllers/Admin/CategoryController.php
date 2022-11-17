<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category_list = Category::all();
        return view('Admin.category.categlist');
    }

    public function create()
    {
        return view('Admin.category.categ_add');
    }

    public function store()
    {

    }


}
