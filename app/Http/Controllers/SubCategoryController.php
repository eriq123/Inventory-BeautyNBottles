<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sub_Category;
use App\Category;

class SubCategoryController extends Controller
{
	public function SCindex(){
		$categories = Category::all();
		$sub_categories = Sub_Category::all();

		return View('categories.sub_category',compact('categories','sub_categories'));
	}
	public function SCstore(Request $request){
		$request->validate([
		'category'=>'required',
		'sub_category_name'=>'required|max:191',
		]);

		$sub_categories = new Sub_Category();
		$sub_categories->category_id = $request->category;
		$sub_categories->sub_category_name = $request->sub_category_name;
		$sub_categories->save();

		return redirect()->back()->withSuccess('Sub-Category Saved!');
	}

	public function SCedit(Request $request){
		$request->validate([
		'sub_category_name'=>'required|max:191',
		]);

		$sub_categories = Sub_Category::findOrFail($request->id);
		$sub_categories->sub_category_name = $request->sub_category_name;
		$sub_categories->save();

		return redirect()->back()->withSuccess('Sub-Category Updated!');
	}

	public function SCdestroy(Request $request){
		$sub_categories = Sub_Category::findOrFail($request->id);
		$sub_categories->delete();

		return redirect()->back()->withSuccess('Sub-Category Deleted!');
	}
}
