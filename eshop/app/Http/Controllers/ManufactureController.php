<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class ManufactureController extends Controller
{
    public function index(){
    	$this->AdminAuthCheck();
    	return view('admin.add_manufacture');
    }

//Manufacture Save................................................................
	public function save_manufacture(Request $request){
				$data=array();
				$data['manufacture_id']=$request->manufacture_id;
				$data['manufacture_name']=$request->manufacture_name;
				$data['manufacture_description']=$request->manufacture_description;
				$data['publication_status']=$request->publication_status;
		
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
				DB::table('tbl_manufacture')->insert($data);
				Session::put('message', 'Manufacture Added Successfully!!');
				return Redirect::to('/add-manufacture');
	}

//View Manufacture...............................................................	
   public function all_manufacture(){
   	$this->AdminAuthCheck();
   				$all_manufacture=DB::table('tbl_manufacture')->get();
   				$manage_manufacture=view('admin.all_manufacture')
   							->with('all_manufacture_info', $all_manufacture);

   				return view('admin_layout')
   						->with('admin.all_manufacture', $manage_manufacture);			

   		//return view('/admin.all_manufacture');
   }

   // Unactive Manufacture Controller..............................................
	public function unactive_manufacture($manufacture_id){
				DB::table('tbl_manufacture')
				->where('manufacture_id', $manufacture_id)
				->update(['publication_status' =>0 ]);
				Session::put('message', 'Manufacture Unactive Successfully!!');
				return Redirect::to('/all-manufacture');
	}
	
   //Active Manufacture Controller.................................................
	public function active_manufacture($manufacture_id){
				DB::table('tbl_manufacture')
				->where('manufacture_id', $manufacture_id)
				->update(['publication_status' =>1 ]);
				Session::put('message', 'Manufacture Activated Successfully!!');
				return Redirect::to('/all-manufacture');
	}

	//Edit Manufacture.........................................................................
public function edit_manufacture($manufacture_id){
	$this->AdminAuthCheck();
		$edit_manufacture=DB::table('tbl_manufacture')
				->where('manufacture_id', $manufacture_id)
				->first();

		$edit_manage_manufacture=view('admin.edit_manufacture')
				->with('edit_manufacture_info', $edit_manufacture);

		return view('admin_layout')
				->with('admin.edit_manufacture', $edit_manage_manufacture);			
		// return view('admin.edit_manufacture');
}

//Update Manufacture.........................................................................
public function update_manufacture(Request $request, $manufacture_id){
		$data=array();
		$data['manufacture_name']=$request->manufacture_name;	
		$data['manufacture_description']=$request->manufacture_description;
		// echo "<pre>";	
		// print_r($data);
		// echo "</pre>";
		DB::table('tbl_manufacture')
			->where('manufacture_id', $manufacture_id)
			->update($data);

			Session::put('message', 'Manufacture Updated Successfully !!');
			return Redirect::to('all-manufacture');
}

//Delete Manufacture.........................................................................
public function delete_manufacture($manufacture_id){
		DB::table('tbl_manufacture')
			->where('manufacture_id', $manufacture_id)
			->delete();
		Session::put('message', 'Manufacture deleted Successfully');
		return Redirect::to('/all-manufacture');	


		// echo $manufacture_id;	
}

//Logout function................................................................
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
