<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\EcommerceProduct;
use Validator;
class EcommerceProductController extends Controller
{
    public function addEcommerceProduct(Request $request){
        $validator = Validator::make($request->all(),[
            'product_title'=>'required|max:191',
            'product_image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_description'=>'required',
        ]);  
          if($validator->fails()){
            return response()->json([
                'status'=>400,
                'message'=>$validator->errors(),
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
}
