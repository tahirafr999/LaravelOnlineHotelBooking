<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\EcommerceProduct;
use Validator;
use DataTables;
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

}