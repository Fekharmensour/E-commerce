<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProdRequest;
use App\Http\Requests\Product\UpdatePhotosRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\Product\ProductsResource;
use App\Http\Resources\Product\ShowProductResource;
use App\Http\Resources\Product\StockResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(StoreProdRequest $request)
    {
        $seller = Auth::user()->seller;

        if (!$seller) {
            return response()->json(["message" => "Authorization failed"], 401);
        }
        $validatedData = $request->validated();
        $validatedData['seller_id'] = $seller->id;
        $product = Product::where('name', $validatedData['name'])->first();
        if ($product) {
            return response()->json(["message" => "Product already exists"], 401);
        }
        if (!$seller->status) {
            return response()->json(['message' => 'Your seller account is disabled'], 400);
        }
        $product = Product::create($validatedData);
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('product_photos/' . $product->category->name, 'public');
                $product->photos()->create(['photo' => $path]);
            }
        }
        return response()->json(['message' => 'Product created successfully', 'product' => new ProductsResource($product)], 201);
    }

    public function update(UpdateRequest $request ,Product $product)
    {
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if ($product->seller_id != $seller->id || !$product) {
            return response()->json(['message' => 'You cannot edit this product'], 400);
        }
        if (!$seller->status) {
            return response()->json(['message' => 'Your seller account is disabled'], 400);
        }
        $validatedData = $request->validated();
        $productExist = Product::where('name', $validatedData['name'])->where('id', '!=', $product->id)->exists();
        if ($productExist) {
            return response()->json(["message" => "Product with this name already exists, please choose another name"], 401);
        }
        if ($product->update($validatedData)) {
            return response()->json(['message' => 'Product details updated successfully', 'product' => new StockResource($product)], 200);
        } else {
            return response()->json(['message' => 'Failed to update product details'], 500);
        }

    }

    public function updatePhotos(UpdatePhotosRequest $request, Product $product)
    {
        $seller = Auth::user()->seller;

        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if ($product->seller_id != $seller->id || !$product) {
            return response()->json(['message' => 'You cannot edit this product'], 400);
        }

        if (!$seller->status) {
            return response()->json(['message' => 'Your seller account is disabled'], 400);
        }
        $request->validated();
        if ($request->hasFile('photos')) {
            $product->photos()->delete();
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('product_photos/' . $product->category->name, 'public');
                $product->photos()->create(['photo' => $path]);
            }

            return response()->json(['message' => 'Product photos updated successfully', 'product' => new StockResource($product)], 200);
        } else {
            return response()->json(['message' => 'No photos provided to update'], 400);
        }
    }

    public function destroy(Product $product)
    {
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if ($product->seller_id != $seller->id) {
            return response()->json(['message' => 'You cannot delete this product'], 400);
        }
        if (!$seller->status) {
            return response()->json(['message' => 'Your seller account is disabled'], 400);
        }
        $deleted = $product->photos()->delete();
        if ($deleted > 0) {
            if ($product->delete()) {
                return response()->json(['message' => 'Product deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to delete product'], 500);
            }
        } else {
            return response()->json(['message' => 'Failed to delete photos associated with the product'], 500);
        }
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
