<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Productvariant;
use App\Services\ProductvariantService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class ProductvariantController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, ProductvariantService $service)
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

    public function productVariantDetails(Productvariant $variant){
        $categories = Category::all();
        $product = $variant->product;
        $variants = $product->productVariants;
        return view('display.variant-details', [
            'categories' => $categories,
            'product'=>$product,
            'variants'=>$variants,
            'variant'=>$variant]);
    }
}
