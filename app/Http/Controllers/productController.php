<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\product;
use Validator;
use Storage;
use GuzzleHttp;
use App\EcommerceProduct;
use DB;
use Session;


class productController extends Controller
{
    public function save(Request $request){
        $validator = \Validator::make($request->all(),[
            'hotel_title'=>'required|unique:countries,hotel_title,'.$country_id,
            
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
     }else{

     }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'hotel_title'=>'required|max:191',
            'hotel_image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'hotel_description'=>'required',
        ]);  
          if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
             $employee = new product;
             $employee->hotel_title = $request->input('hotel_title');
             $employee->tags = $request->tags;
             $employee->product_category = $request->product_category;
             $employee->product_author = $request->product_author;
             $employee->hotel_description = $request->hotel_description;
             if($request->hasFile('hotel_image')){
                 $file = $request->file('hotel_image');
                 $extension = $file->getClientOriginalExtension();
                 $filename = time().'.'.$extension;
                 $file->move('images',$filename);
                 $employee->hotel_image = $filename;
             } 
            $employee->save();

            return response()->json([
                'status'=>200,
                'message'=>'Product Added Successfully'
            ]);
           
        }

    }



    public function FetchHotel(){
        $hotel = product::all();
        return view('admin/hotel/manage_hotel_detail', ['hoteltable'=>$hotel]);
    }

    public function FetchDataFrondend(){
        $frond_data = product::all();
        $username = Session::get('username');
        // $ecommerceProduct = EcommerceProduct::all();
        $userList = DB::table('users')->where('username',$username)->first();
        // DD($userList);
        $recommenedList = DB::table('recommended_products')->where('user_id',  $userList->id)->get();
        // DD($recommenedList);
        if(count($recommenedList)>0){
            $ecommerceProduct = DB::table('recommended_products')->where('user_id',$userList->id)
            // ->where('category_clicks', DB::raw("(select max(`category_clicks`) from recommended_products)"))
            ->orderBy('category_clicks', 'DESC')
            // orWhere('category_clicks = (select max(`category_clicks`) from recommended_products)')
            // DB::table('orders')->max('id');
            // ->whereRaw('select max(`category_clicks`) from  recommended_products where `user_id` = 21')
            ->get();
            // dd($recommenedProductList);
        }else{
            $ecommerceProduct = DB::table('recommended_products')->where('user_id', "!=",  $userList->id)->get();
            // dd($recommenedProductListSecond);
        }
        // $recommenedProductList = DB::table('recommended_products')->where('user_id',$userList->id)
        // // ->where('category_clicks', DB::raw("(select max(`category_clicks`) from recommended_products)"))
        // ->orderBy('category_clicks', 'DESC')
        // // orWhere('category_clicks = (select max(`category_clicks`) from recommended_products)')
        // // DB::table('orders')->max('id');
        // // ->whereRaw('select max(`category_clicks`) from  recommended_products where `user_id` = 21')
        // ->get();
        // dd($recommenedProductList);

        // return view('index',compact('frond_data','recommenedProductListSecond'));
        return view("index", ["ecommerceProduct"=>$ecommerceProduct,"frond_data"=>$frond_data]);
    }


    // hello
    public function EditHotel($id){
        $hotel = product::find($id);
        if($hotel){
            return response()->json([
                'status'=>200,
                'hotel'=>$hotel
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Not Found'
            ]);
        }
    }

    public function UpdateHotel(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'hotel_title'=>'required|max:191',
        ]);  
          if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
             $employee = product::find($id);
             if($employee){
                $employee->hotel_title = $request->input('hotel_title');
                if($request->hasFile('hotel_image')){
                    $path = 'images'.$employee->hotel_image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                    $file = $request->file('hotel_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('images',$filename);
                    $employee->hotel_image = $filename;
                }  
                $employee->update();
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

    public function DeleteHotel($country_id){
        $hotel = product::find($country_id);
        $destination = 'images/'.$hotel->hotel_image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $hotel->delete();
        return response()->json(['msg'=>'Countries have been deleted from database']); 

        // return redirect()->back()->with('status','Hotel image Deleted Successfully');
    }


}

