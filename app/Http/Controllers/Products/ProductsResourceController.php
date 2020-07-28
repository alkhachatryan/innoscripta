<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\GetProductsRequest;
use App\Product;
use \Illuminate\Support\Facades\Schema;

class ProductsResourceController extends Controller
{
    public function index(GetProductsRequest $request){
        $products = Product::query();

        $orderBy = $request->filled('sort_by')
            ? $request->input('sort_by')
            : 'id';

        $filter = $request->input('filter') === 'asc' ? 'ASC' : 'DESC';

        $limit = $request->filled('limit') ? $request->input('limit') : 30;

        $products->orderBy($orderBy, $filter);

        return $products->paginate($limit);
    }

    public function single($slug){
        $product = Product::whereSlug($slug)->first();

        if(! $product)
            return response()->json(Product::NOT_FOUND, 404);

        return response()->json($product);
    }
}
