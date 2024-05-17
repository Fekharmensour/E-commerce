<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\BuyerResource;
use App\Http\Resources\Complaint\ProdResource;
use App\Http\Resources\Complaint\ReviewResource;
use App\Http\Resources\Complaint\SellerResource;
use App\Models\Buyer;
use App\Models\Complaint;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function ComplaintProd(Request $request , Product $product){
        $buyer = Auth::user();
        if(!$buyer){
            return response()->json(['message' => 'Authentication required'] , 401);
        }
        if (!$product){
            return response()->json(['message' => 'Invalid product'] , 401);
        }
        $seller = $product->seller ;
        if ( $seller->id != $buyer->seller->id) {
            return response()->json(['message' => "Can't send the Complaint "] , 401);
        }
        $exist = Complaint::where('about_id' , $product->id)->exists() ;
        if ($exist) {
            return response()->json(['message' => 'Complaint already Exist '] , 401);
        }
        $validation = $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
        ]);
        $validation['about'] = 'product' ;
        $validation['about_id'] = $product->id ;
        $validation['buyer_id'] = $buyer->id ;
        $complaint = Complaint::create($validation);
        if(!$complaint){
            return response()->json(['message' => 'Invalid complaint'] , 401);
        }
        return response()->json(['message' => 'complaint created successfully' , 'complaint' => new ProdResource($complaint)] , 201);
    }

    public function ComplaintReview(Request $request , Review $review)
    {
        $buyer = Auth::user();

        if(!$buyer ){
            return response()->json(['message' => 'Authentication required' ] , 401);
        }
        if (!$review) {
            return response()->json(['message' => 'Review Not Found'] , 401);
        }
        $seller = $review->product->seller ;
        if ( $seller->id != $buyer->seller->id) {
            return response()->json(['message' => "Can't send the Complaint "] , 401);
        }
        $exist = Complaint::where('about_id' , $review->id)->exists() ;
        if ($exist) {
            return response()->json(['message' => 'Complaint already Exist '] , 401);
        }
        $validation = $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
        ]);
        $validation['about'] = 'review' ;
        $validation['about_id'] = $review->id;
        $validation['buyer_id'] = $buyer->id ;
        $complaint = Complaint::create($validation);
        return response()->json(['message' => 'complaint created successfully' , 'complaint' => new ReviewResource($complaint)] ,201);
    }

    public function ComplaintBuyer(Request $request , Order $order)
    {
        $writer_Complaint = Auth::user();
        if(!$writer_Complaint){
            return response()->json(['message' => 'Authentication required'] , 401);
        }
        if ( !$order ){
            return response()->json(['message' => 'Buyer Not Found'] , 401);
        }
        $buyer = $order->cart->buyer;
        if (!$buyer){
            return response()->json(['message' => 'Buyer Not Found'] , 401);
        }
        $seller = $order->cart->product->seller ;
        if ( $seller->id != $writer_Complaint->seller->id) {
            return response()->json(['message' => "Can't send the Complaint "] , 401);
        }
        $exist = Complaint::where('about_id' , $buyer->id)->exists() ;
        if ($exist) {
            return response()->json(['message' => 'Complaint already Exist '] , 401);
        }
        $validation = $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
        ]);
        $validation['about'] = 'buyer' ;
        $validation['about_id'] = $buyer->id;
        $validation['buyer_id'] = $writer_Complaint->id ;
        $complaint = Complaint::create($validation);
        return response()->json(['message' => 'complaint created successfully' , 'complaint' => new BuyerResource($complaint)] ,201);
    }

    public function ComplaintSeller(Request $request , Order $order)
    {
        $writer_Complaint = Auth::user();
        if(!$writer_Complaint){
            return response()->json(['message' => 'Authentication required'] , 401);
        }
        if (!$order){
            return response()->json(['message' => 'Order Not Found'] , 401);
        }
        $seller = $order->cart->product->seller ;
        if (!$seller){
            return response()->json(['message' => 'Buyer Not Found'] , 401);
        }
        $buyer = $order->cart->buyer ;
        if ($buyer->id != $writer_Complaint->id){
            return response()->json(['message' => "Can't send the Complaint "] , 401);
        }
        $exist = Complaint::where('about_id' , $seller->id)->exists() ;
        if ($exist) {
            return response()->json(['message' => 'Complaint already Exist '] , 401);
        }
        $validation = $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
        ]);
        $validation['about'] = 'seller' ;
        $validation['about_id'] = $seller->id;
        $validation['buyer_id'] = $writer_Complaint->id ;
        $complaint = Complaint::create($validation);
        return response()->json(['message' => 'complaint created successfully' , 'complaint' => new SellerResource($complaint)] ,201);
    }


    public function buyerIndex()
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $complaints = Complaint::where('about' , 'buyer')->get();
        return BuyerResource::collection($complaints);
    }
    public function sellerIndex()
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $complaints = Complaint::where('about' , 'seller')->get();
        return SellerResource::collection($complaints);
    }
    public function reviewIndex()
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $complaints = Complaint::where('about' , 'review')->get();
        return ReviewResource::collection($complaints);
    }
    public function productIndex()
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $complaints = Complaint::where('about' , 'product')->get();
        return ProdResource::collection($complaints);
    }

    public function delete(Complaint $complaint)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$complaint){
            return response()->json(['message'=> 'Compliant Not Found']) ;
        }
        $complaint->delete();
        return response()->json(['message' => 'complaint deleted successfully'] , 200);

    }
    public function DeleteReview(Review $review , Complaint $complaint)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$review){
            return response()->json(['message' => 'Review Not Found'] , 401);
        }
        if(!$complaint){
            return response()->json(['message' => 'Complaint Not Found'] , 401);
        }
        $complaint->delete();
        $review->delete();
        return response()->json(['message' => 'review deleted successfully'] , 200);
    }
    public function DeleteBuyer(Buyer $buyer , Complaint $complaint)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$buyer){
            return response()->json(['message' => 'Buyer Not Found'] , 401);
        }
        if (!$complaint){
            return response()->json(['message' => 'Complaint Not Found'] , 401);
        }
        $complaint->delete();
        $buyer->delete();
        return response()->json(['message' => 'buyer deleted successfully'] , 200);
    }
    public function DeleteProduct(Product $product , Complaint $complaint)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$product){
            return response()->json(['message' => 'Product Not Found'] , 401);
        }
        if (!$complaint){
            return response()->json(['message' => 'Complaint Not Found'] , 401);
        }
        $complaint->delete();
        $product->delete();
        return response()->json(['message' => 'product deleted successfully'] , 200);
    }
    public function DisableSeller(Seller $seller , Complaint $complaint)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$seller){
            return response()->json(['message' => 'Seller Not Found'] , 401);
        }
        if (!$complaint){
            return response()->json(['message' => 'Complaint Not Found'] , 401);
        }
        $complaint->delete();
        $seller->status = false ;
        $seller->save();
        return response()->json(['message' => 'Seller Disabled successfully'] , 200);
    }
}
