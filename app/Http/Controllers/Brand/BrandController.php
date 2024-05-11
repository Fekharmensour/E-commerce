<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Brand\DisabledBrandResource;
use App\Http\Resources\Brand\ShowBrandResource;
use App\Models\Brand;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    //
    public function index()
    {
        $brands = Brand::withCount('sellers')->get();
        $brands = $brands->where('status', 1)->sortByDesc('created_at');
        return response()->json(['brands' => BrandResource::collection($brands) ], 200);
    }
    public function showBrand(Brand $brand)
    {
        $brand->load(['sellers' => function ($query) {
            $query->with('buyer');
        }]);
        return response()->json(['brand' => new BrandResource($brand) ], 200);
    }
    public function store(Request $request)
    {
        $validateData = request()->validate( [
            'name' => 'required|string|max:255|unique:brands,name',
            'commercialRecord' => 'required|file|mimes:pdf|max:2048'
        ]);
        $buyer = Auth::user();
        if ($buyer->seller()->exists()) {
            return response()->json(['message' => 'Buyer is already a seller'], 400);
        }$buyer = Auth::user();
        if ($buyer->seller()->exists()) {
            return response()->json(['message' => 'Buyer is already a seller'], 400);
        }
        if ($request->hasFile('logo')) {
           $validateData['logo'] = 'nullable|image|max:2048' ;
           $logoPath = $request->file('logo')->store('brand_logos', 'public');
           $validateData['logo'] = $logoPath;
        }
        if ($request->hasFile('background_image')) {
            $validateData['background_image'] = 'nullable|image|max:2048';
            $backgroundImagePath = $request->file('background_image')->store('brand_backgrounds', 'public');
            $validateData['background_image'] = $backgroundImagePath;
        }
        $brand = Brand::create([
            'name' => $request->name,
            'logo' => $validateData['logo'] ?? null,
            'background_image' => $validateData['background_image'] ?? null,
        ]);
        if ($brand){
            if ($request->hasFile('commercialRecord')) {
                $path = $request->file('commercialRecord')->store('commercialRecord', 'public');
                $validateData['commercialRecord'] = $path;
            }
            $seller = Seller::create([
                'buyer_id' => $buyer->id,
                'brand_id' => $brand->id,
                'commercialRecord' => $validateData['commercialRecord'] , // Store file path or null if no file
                'is_owner' => true,
            ]);
        }else{
            return response()->json(['message' => 'Brand not added'], 400);
        }
        if (!$seller){
            $brand->delete();
            return response()->json(['message' => 'Some think has been wrong'], 400);
        }
        $buyer->role = true ;
        $buyer->save() ;
        return response()->json(['message' => 'Brand and Seller Account  created successfully' , 'seller' => $seller], 201);
    }

    public function disabledBrands(){
        $brands = Brand::where('status', false)
            ->with(['sellers' => function ($query) {
                $query->where('is_owner', true);
            }])
            ->get();
        $brands = DisabledBrandResource::collection($brands) ;
        return response()->json(['DisabledBrands' => $brands ,  ], 200);
    }



}
