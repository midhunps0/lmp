<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Category;
use App\Models\Cart;

class ProductController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, ProductService $service)
    {
        parent::__construct($request);
        $this->connectorService = $service;
        // $this->itemName = null;
        // $this->unauthorisedView = 'easyadmin::admin.unauthorised';
        // $this->errorView = 'easyadmin::admin.error';
        // $this->indexView = 'easyadmin::admin.indexpanel';
        // $this->showView = 'easyadmin::admin.show';
        // $this->createView = 'easyadmin::admin.form';
        // $this->editView = 'easyadmin::admin.form';
        // $this->itemsCount = 10;
        // $this->resultsName = 'results';
    }
    public function productIndex(){
        $categories=Category::all();
        $products=Product::with('tags')->paginate(8);
        $wishlist=Wishlist::all();
        $cart=Cart::all();
        
        return view('display.index',['categories'=>$categories,'products'=>$products,'wishlist'=>$wishlist,'cart'=>$cart]);
    }
    public function productShow(Product $product){
        $categories=Category::all();
        
       
        return view('display.product-details',['categories'=>$categories,'product'=>$product]);
    }


    public function search(Request $request){
        $categories=Category::all();
        $query=$request->input('search');
        


         // Search for products with matching names
         $productResults = Product::where('name','like','%'.$query.'%')
                        ->orWhere('description','like','%'.$query.'%')
                        ->with('tags')->get();

         // Search for products with matching categories
         $categoryResults = Category::where('name', 'like', '%' . $query . '%')
             ->with('products') // Assuming a relationship between Category and Product
             ->get()
             ->pluck('products')
             ->flatten();
 
         // Merge and deduplicate the results
         $results = $productResults->merge($categoryResults)->unique();
                return view('display.search',['categories'=>$categories,'results'=>$results,'query'=>$query]);
    }

}
