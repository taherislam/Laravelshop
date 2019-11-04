<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class CategoryController extends Controller
{
   public function index(){
   	$this->AdminAuthCheck();
   		return view('/admin.add_category');
   }
//Category Save................................................................
	public function save_category(Request $request){
				$data=array();
				$data['category_id']=$request->category_id;
				$data['category_name']=$request->category_name;
				$data['category_description']=$request->category_description;
				$data['publication_status']=$request->publication_status;
		
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
				DB::table('tbl_category')->insert($data);
				Session::put('message', 'Category Added Successfully!!');
				return Redirect::to('/add-category');
	}

//View Category...............................................................	
   public function all_category(){
   			$this->AdminAuthCheck();

   				$all_category=DB::table('tbl_category')->get();
   				$manage_category=view('admin.all_category')
   							->with('all_category_info', $all_category);

   				return view('admin_layout')
   						->with('admin.all_category', $manage_category);			

   		//return view('/admin.all_category');
   }


// Unactive Category Controller.............................................
	public function unactive_category($category_id){
				DB::table('tbl_category')
				->where('category_id', $category_id)
				->update(['publication_status' =>0 ]);
				Session::put('message', 'Category Unactive Successfully!!');
				return Redirect::to('/all-category');
	}

   //Active Category Controller.................................................
	public function active_category($category_id){
				DB::table('tbl_category')
				->where('category_id', $category_id)
				->update(['publication_status' =>1 ]);
				Session::put('message', 'Category Activated Successfully!!');
				return Redirect::to('/all-category');
	}

//Edit Category.........................................................................
public function edit_category($category_id){
	$this->AdminAuthCheck();
		$edit_category=DB::table('tbl_category')
				->where('category_id', $category_id)
				->first();

		$edit_manage_category=view('admin.edit_category')
				->with('edit_category_info', $edit_category);

		return view('admin_layout')
				->with('admin.edit_category', $edit_manage_category);			
		// return view('admin.edit_category');
}

//Update Category.........................................................................
public function update_category(Request $request, $category_id){
		$data=array();
		$data['category_name']=$request->category_name;	
		$data['category_description']=$request->category_description;
		// echo "<pre>";	
		// print_r($data);
		// echo "</pre>";
		DB::table('tbl_category')
			->where('category_id', $category_id)
			->update($data);

			Session::put('message', 'Category Updated Successfully !!');
			return Redirect::to('all-category');
}

//Delete Category.........................................................................
public function delete_category($category_id){
		DB::table('tbl_category')
			->where('category_id', $category_id)
			->delete();
		Session::put('message', 'Category deleted Successfully');
		return Redirect::to('/all-category');	


		// echo $category_id;	
}

//Logout functiojn ......................................................................
//$this->AdminAuthCheck();
 public function AdminAuthCheck(){
    	$admin_id=Session::get('admin_id');
    	
    	if ($admin_id) {
    		return;
    	}else{
    		return Redirect::to('/admin')->send();
    	}
    }


}
