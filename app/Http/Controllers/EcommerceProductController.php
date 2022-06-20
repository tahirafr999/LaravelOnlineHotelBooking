<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\EcommerceProduct;
use App\Cart;
use App\placeOrders;
use Validator;
use DataTables;
use DB;
use Session;
use Response;
use Stripe;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Imports\UsersImport;
class EcommerceProductController extends Controller
{
    public function addEcommerceProduct(Request $request){
        $validator = Validator::make($request->all(),[
            'product_title'=>'required|max:191',
            'product_author'=>'required|max:191',
            'product_image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_description'=>'required',
        ]);  

        
          if($validator->fails()){
            return  response()->json([
                'status'=>400,
                'message'=>$validator->messages(),
            ]);
        }
        else{
             $EcommerceProduct = new EcommerceProduct;
             $EcommerceProduct->title = $request->product_title;
             $EcommerceProduct->author = $request->product_author;
             $EcommerceProduct->product_price = $request->product_price;
             $EcommerceProduct->category = $request->product_category;
             $EcommerceProduct->product_description = $request->product_description;
             if($request->hasFile('product_image')){
                 $file = $request->file('product_image');
                 $extension = $file->getClientOriginalExtension();
                 $filename = time().'.'.$extension;
                 $file->move('images',$filename);
                 $EcommerceProduct->photo = $filename;
             } 
            $EcommerceProduct->save();

            return response()->json([
                'status'=>200,
                'message'=>'Product Added Successfully'
            ]);
           
        }

    }

    public function getAllProducts(){
        $products = EcommerceProduct::all();
        return DataTables::of($products)
        ->addIndexColumn()
        ->addColumn('actions', function($row){
            return '<div class="btn-group">
                          <button class="btn btn-sm btn-primary" data-id="'.$row['id'].'" id="editProductBtn">Update</button>
                          <button class="btn btn-sm btn-danger" data-id="'.$row['id'].'" id="deleteProductBtn">Delete</button>
                    </div>';
                    
                    
        })
        ->addColumn('product_image', function ($product_brand) { 
            $url=asset("uploads/image/$product_brand->image"); 
            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
     })
        
        ->rawColumns(['actions'])
                            ->make(true);
        }


            //GET COUNTRY DETAILS
    public function getProductDetails($id){
        $details = EcommerceProduct::find($id);
        if($details){
            return response()->json([
                'status'=>200,
                'details'=>$details
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Not Found'
            ]);
        }
  }

  public function getupdateProduct(Request $request, $id){
    $validator = Validator::make($request->all(),[
        'product_title'=>'required|max:191',
        'product_author'=>'required|max:191',
        'product_category'=>'required|max:191',
        'product_price'=>'required|max:191',
        'product_description'=>'required|max:191',
        // 'product_image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);  
      if($validator->fails()){
        return response()->json([
            'status'=>400,
            'message'=>$validator->messages(),
        ]);
    }
    else{
         $product = EcommerceProduct::find($id);
         if($product){
             $product->title = $request->input('product_title');
             $product->author = $request->input('product_author');
            if($request->hasFile('product_image')){
                $path = 'images'.$product->photo;
                if(File::exists($path)){
                    File::delete($path);
                }
                $file = $request->file('product_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('images',$filename);
                $product->photo = $filename;
            }  
            $product->category = $request->input('product_category');
            $product->product_price = $request->input('product_price');
            $product->product_description = $request->input('product_description');
            $product->update();
            return response()->json([
                'status'=>200,
                'message'=>'updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Not Found'
            ]);
        }
        
       
    }
}

public function getdeleteHotel($product_id){
    $product = EcommerceProduct::find($product_id);
    $destination = 'images/'.$product->photo;
    if(File::exists($destination)){
        File::delete($destination);
    }
    $product->delete();
    return response()->json(['msg'=>'Product have been deleted from database']); 

    // return redirect()->back()->with('status','Hotel image Deleted Successfully');
}

Public function getCountCart(Request $request, $id){
    $ecommerce_products = DB::table('ecommerce_products')->where('id', $id)->first();
    $EcommerceProduct = new Cart;
    $EcommerceProduct->product_id = $ecommerce_products->id;
    $EcommerceProduct->product_name = $ecommerce_products->title;
    $EcommerceProduct->product_author = $ecommerce_products->author;
    $EcommerceProduct->	addToCartUserID = Auth::id();
    $EcommerceProduct->product_category = $ecommerce_products->category;
    $EcommerceProduct->product_image = $ecommerce_products->photo;
    $EcommerceProduct->product_price = $ecommerce_products->product_price;
    $EcommerceProduct->save(); 
    return response()->json([
        'status'=>200,
        'message'=>'Product Added to the Cart Successfully'
    ]); 
    

}

Public function getCartAllProducts(){
    $CartList = Cart::all();
    return view('cart_details', ['product'=>$CartList]);
}

public function updateCartQuantity($quantity,$id){
    
$cartQuantityIncrement =  DB::table('carts')->where('product_id',$id)->update(['quantity' => DB::raw('quantity + 1') ]);
$cartQuantity =   DB::table('carts')->select('quantity')->where('product_id',$id)->get();
// dd($cartQuantity);
// return \Response::json($response);
return Response::json(array(
    'success' => true,
    'message'   => "Change Cart Quantity Successfully",
  )); 
    // return redirect('/cart_details')->with('flash_message_success','Product Quantity has been updated Successfully');
}

public function getCheckout(){
    $user_id = Auth::user()->id;
    // $cartDetails = Cart::select('product_name')->where('addToCartUserID',$user_id)->count();
    // $checkoutDetails = Cart::select()->where('addToCartUserID',$user_id)->first();
    $checkoutDetails = DB::table('carts')->where('addToCartUserID',$user_id)->count();
    $cartData = DB::table('carts')->where('addToCartUserID',$user_id)->first();
    // echo "</pre>"; print_r($checkoutDetails); exit;
    // $shippingDetails = array();
    if($checkoutDetails > 0){
        $checkoutDetailPage = DB::table('carts')->where('addToCartUserID',$user_id)->get();
    }
    // dd($checkoutDetails);
    return view('checkout_details',compact('checkoutDetailPage','cartData'));
    // return view('checkout_details', ['checkoutProducts' => $checkoutDetailPage]);
    // eturn view('user.index', ['users' => $users]);
    
    // dd($totalAmount);
}

public function getPlaceOrder(Request $request){
    $user_id = Auth::user()->id;
    $payment_method = $request->payment_method;
    $grand_total = $request->grand_total;
    $userList = DB::table('users')->where('id',$user_id)->first();
    $order = new placeOrders ;
    $order->user_id = $userList->id;
    $order->product_id = $request->product_id;
    $order->company_name = $userList->company_name;
    $order->email = $userList->email;
    $order->grand_total = $request->grand_total;
    $order->payment_method = $request->payment_method;
    $order->save();
    $order_id = DB::getPdo()->lastinsertID();

    Session::put('order_id',$order_id);
    Session::put('grand_total',$grand_total);

    if($payment_method == "cod"){
       return redirect('/thanks');
    }else{
        return redirect('/stripe');
    }

}

public function thanks(){
    $user_id = Auth::user()->id;
    DB::table('carts')->where('addToCartUserID',$user_id)->delete();
    return view('cod_thanks');
}

public function getStripe(){
    return view('stripe');
}

public function getStripePayment(Request $request){
    $data = $request->all();
    // dd($data);
    // apikeys
            \Stripe\Stripe::setApiKey(' sk_test_51IUyrOF9adkmVg5fOqQPCud0OPxc779lTJdhWMgI8CONVYdBrZk3IdunSKniMSNpF3GIRdqSAUhLtAc8oBNExyUw00eTWexYlN');
            $token = $_POST['stripeToken'];
            $charge = \Stripe\charge::Create([
                
              'amount' => $request->input('total_amount')*100,
              'currency' => 'pkr',
              'description' => $request->input('name'), 
              'source' => $token,
            ]);
            return redirect()->back()->with('flash_message_success','Your Payment Successfully Done!');
}

public function pdf(){

    $pdf = PDF::loadView('pdf');
    return $pdf->download('invoices.pdf');
}

public function getCryptoCurrency(Request $request){
    $response = Http::get("https://api.nomics.com/v1/currencies/ticker?key=c0955495cec1f20bdb39fdd6095a0ba160ed3d4f&ids=BTC,ETH,XRP&interval=1d,30d&convert=PKR&platform-currency=ETH&per-page=100&page=1");
    
    return view('crypto',['response'=>$response->json()]);
}
// curl "https://api.nomics.com/v1/currencies/ticker?key=c0955495cec1f20bdb39fdd6095a0ba160ed3d4f&ids=BTC,ETH,XRP&interval=1d,30d&convert=EUR&platform-currency=ETH&per-page=100&page=1"
// https://api.nomics.com/v1/markets?key=c0955495cec1f20bdb39fdd6095a0ba160ed3d4f

//  function getdata(){

//      return ["name"];
//  }


  public function getSuggestedProductDetails($id){
      $ProductId = $id;
      $userName = Session::get("username");
      $EcommerceProduct = DB::table('ecommerce_products')->where('id',$ProductId)->first();
      $RecommededProduct = DB::table('recommended_products')->where('product_id',$ProductId)->get(); 
    //   echo count($RecommededProduct); die;
      if(count($RecommededProduct)>0){
        DB::table('recommended_products')
        ->where('product_id', $id)  
        ->limit(1)
        ->update(array('category_clicks' => \DB::raw('category_clicks + 1'))); 
      }else{
        DB::table('recommended_products')->insert(['product_id'=>$EcommerceProduct->id,'username'=>$userName,'title'=>$EcommerceProduct->title,'author'=>$EcommerceProduct->author,'photo'=>$EcommerceProduct->photo,'category'=>$EcommerceProduct->category,'product_description'=>$EcommerceProduct->product_description,'product_price'=>$EcommerceProduct->product_price]);
      }
            return view('final_year_project/Category_Suggested/productDetails')->with('flash_message_success','Your Payment Successfully Done!');

}

    public function importUsers(){
        return view('excel.import');
    }

    public function uploadUsers(Request $request){
        $file = $request->file('file');
         Excel::import(new UsersImport, $file);
        
        return view('excel.import')->with('success', 'User Imported Successfully');

    }

    public function export(){

    }

}


