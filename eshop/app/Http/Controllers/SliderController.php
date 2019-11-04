<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class SliderController extends Controller
{
    public function index(){
    	return view('admin.add_slider');
    }

    //Add/Save Slider............................................
    public function save_slider(Request $request){
    		$data=array();
    		$data['publication_status']=$request->publication_status;
    		$image=$request->file('slider_image');

			if($image){
				$image_name=str_random(20);
				$ext=strtolower($image->getClientOriginalExtension());
				$image_full_name=$image_name.'.'.$ext;
				$upload_path='slider/';
				$image_url=$upload_path.$image_full_name;
				$success=$image->move($upload_path,$image_full_name);
				if($success){
					$data['slider_image']=$image_url;

					DB::table('tbl_slider')->insert($data);
					Session::put('message', 'Slider added successfully!!' );
					return Redirect::to('/add-slider');
				}
			}
			
			$data['slider_image']='';
			DB::table('tbl_slider')->insert($data);
			Session::put('message', 'Slider added successfully without Image !!' );
			return Redirect::to('/add-slider');
    }

    public function all_slider(){
    		$all_slider=DB::table('tbl_slider')->get();
   				$manage_slider=view('admin.all_slider')
   							->with('all_slider_info', $all_slider);

   				return view('admin_layout')
   						->with('admin.all_slider', $manage_slider);		

    	// return view('admin.all_slider');
    }

    //Unactive Slider controller...............................................................
public function unactive_slider($slider_id){
	DB::table('tbl_slider')
				->where('slider_id', $slider_id)
				->update(['publication_status' =>0 ]);
				Session::put('message', 'Slider Unactive Successfully!!');
				return Redirect::to('/all-slider');
}

 //Active Slider Controller..............................................................
	public function active_slider($slider_id){
				DB::table('tbl_slider')
				->where('slider_id', $slider_id)
				->update(['publication_status' =>1 ]);
				Session::put('message', 'Slider Activated Successfully!!');
				return Redirect::to('/all-slider');
	}

//Delete Slider Controller................................................................
public function delete_slider($slider_id){
		DB::table('tbl_slider')
			->where('slider_id', $slider_id)
			->delete();
		Session::put('message', 'Slider deleted Successfully');
		return Redirect::to('/all-slider');	


		// echo $slider_id;	
}





}
