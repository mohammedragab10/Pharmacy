<?php

namespace App\Http\Controllers;

// namespace App\Http\Controllers\Str;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
  function AddProduct()
  {
    $allcate = category::all();

    return view('products.addproduct', ['allcate' => $allcate]);
  }

  function RemoveProduct($productid = null)
  {
    if ($productid != null) {
      $currentProduct = Product::find($productid);
      $currentProduct->delete();
      return redirect('/product');
    } else {
      abort(403, 'You must enter product ID');
    }
  }


  function EditProduct($productid = null)
  {

    if ($productid != null) {
      $currentProduct = Product::find($productid);
      if ($currentProduct == null) {
        abort("403", "can't find products");
      }
      $allcate = category::all();
      return view('products.editproduct', ["product" => $currentProduct, 'allcate' => $allcate]);
    } else {
      return redirect('/addproduct');
    }
  }


  function showProduct($productid)
  {
    $product = product::with('Category')->find($productid);
    $relatedProducts = Product::where('category_id',$product->category_id)->where('id','!=',$productid)
    ->inRandomorder()
    ->limit(3)
    ->get();
    return view('products.showProduct',['product'=>$product,'relatedProducts'=>$relatedProducts]);
  }


  function StoreProduct(Request $request)
  {

      $request->validate([
      'name' => 'required|max:50',
      'price' => 'required',
      'amount' => 'required',
      'description' => 'required',
      'photo' => 'image|mimes:png,jpg,gif,jpeg|max:2048'
    ]);

    if($request->id){
     $currentProduct = Product::find($request->id);
     $currentProduct -> name = $request->name;
     $currentProduct -> price = $request->price;
     $currentProduct -> amount = $request->amount;
     $currentProduct -> description = $request->description;
     $currentProduct -> category_id = $request->category_id;
     if($request->has('photo')){
       $path= $request->photo->move('uploads',Str::uuid()->toString(). '-' .$request->photo->getClientOriginalName());
      $currentProduct->imagepath=$path;
      }
     $currentProduct->save();
     return redirect('product');
    }
    else{
    $newProduct = new product();
    $newProduct->name = $request->name;
    $newProduct->price = $request->price;
    $newProduct->amount = $request->amount;
    $newProduct->description = $request->description;
    $path='';
    if($request->has('photo')){  $path= $request->photo->move('uploads',Str::uuid()->toString(). '-' .$request->photo->getClientOriginalName());
}
    $newProduct->imagepath = $path;
    $newProduct->category_id = $request->category_id;

    $newProduct->save();

    return redirect('/');
  }
 }
}
