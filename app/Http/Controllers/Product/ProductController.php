<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProdRequest;
use App\Http\Resources\Product\ProductsResource;
use App\Http\Resources\Product\ShowProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(StoreProdRequest $request)
    {
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message"=> "authorization failed"], 401);
        }else{
            $seller = $buyer->seller() ;
            if (!$seller){
                return response()->json(["message"=> "authorization failed"], 401);
            }
        }
        $validateData = $request->validated();
        $seller = Seller::find($seller);
        if (!$seller || !$seller->status) {
            return response()->json(['message' => 'Your seller account is disabled'], 400);
        }
        $product = Product::create($validateData);
        if ($request->hasFile('photos')) {
            foreach ($request->photos as $photo) {
                $path = $photo->store('product_photos/'.$product->category->name , 'public');
                $product->photos()->create(['photo' => $path]);
            }
        }
        return response()->json(['message' => 'Product created successfully' , 'product' => new ProductsResource($product) ], 201);

    }

    public  function showProduct(Product $product){
        return response()->json(['product' => new ShowProductResource($product)]);
    }

    public function index(Request $request)
    {
        $products = Product::with(['category', 'seller', 'photos']);
        if($request->has('search')){
            $products = $products->where('name' , 'like' ,"%" . request()->get('search', '') . "%");
        }
        if ($request->has('category_id')) {
            $products = $products->where('category_id' ,  $request->get('category_id'));
        }
        if ($request->has('min_price')) {
            $products = $products->where('price', '>=', $request->get('min_price'));
        }
        if ($request->has('max_price')) {
            $products = $products->where('price', '<=', $request->get('max_price'));
        }

        $products = $products->paginate(8);
        $formattedProducts = $products->map(function ($product) {
            return  new ProductsResource($product);
        });

        return response()->json([
            'products' => $formattedProducts,
            'paginate' => [
                'total' => $products->total(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'path' => $products->path(),
                'prev_page_url' => $products->previousPageUrl(),
                'next_page_url' => $products->nextPageUrl(),
            ],
        ]);
    }

    public function indexCategory()
    {
        $category = Category::select('id', 'name', 'logo')->get();
        return  response()->json(['categories' => $category] , 200) ;
    }

}
