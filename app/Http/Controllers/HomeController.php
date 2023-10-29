<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home() : View
    {
        $category = Category::getDefault();

        return view('catalogs', compact('category'));
    }

    public function categoryItems(Category $category) : View
    {
        return view('catalogs', compact('category'));
    }
}
