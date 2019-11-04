<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\Redirect;
class CartController extends Controller
{ 

//Add_to_Cart  Controller....................................................................
    public function add_to_cart(Request $request){
    		
    		$qty=$request->qty;
    		$product_id=$request->product_id;
    		$product_info=DB::table('tbl_products')
    					->where('product_id',$product_id)
    					->first();
    		// echo "<pre>";
    		// print_r($product_info);			
    		// echo "</pre>";	

    		$data['qty']=$qty;
    		$data['id']=$product_info->product_id;		
    		$data['name']=$product_info->product_name;		
    		$data['price']=$product_info->product_price;		
    		$data['options']['image']=$product_info->product_image;	

    		Cart::add($data);
    		return Redirect::to('/show-cart');		
    }
    
//Show Cart Controller....................................................................
    public function show_cart(){
    		$all_published_cart=DB::table('tbl_products')
    							->where('publication_status', 1)
    							->get();


    		$manage_published_cart=view('pages.add_to_cart')
   					->with('all_published_cart_info', $all_published_cart);

   			return view('layout')
   					->with('pages.add_to_cart', $manage_published_cart);
				

    }

//Delete Cart Controller....................................................................
    public function delete_to_cart($rowId){
                // echo $rowId;
            Cart::update($rowId, 0);
           return Redirect::to('/show-cart');    

    }

//Update Cart Controller....................................................................
    public function update_cart(Request $request){
        $qty=$request->qty;
        $rowId=$request->rowId;

        // echo "<pre>";
        // print_r($rowId);
        // echo "</pre>";

         Cart::update($rowId, $qty);
           return Redirect::to('/show-cart');    

    }
}
