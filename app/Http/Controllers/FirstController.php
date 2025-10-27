<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    function mainpage()
    {

        $categories = category::all();
        return view('welcome', ['categories' => $categories]);
    }

    function Getproduct($catid = null)
    {
        if($catid){

        $products = product::where('category_id', $catid)->paginate(3);
        return view('product', ['products' => $products]);
        }

        else{
        $products = product::paginate(3);
        return view('product', ['products' => $products]);
        }
    }

    function Getcategory()
    {

        $categories = category::all();
        $products = product::all();
        return view('category', ['products' => $products, 'categories' => $categories]);
    }
}
