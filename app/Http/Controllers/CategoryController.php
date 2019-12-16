<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	public function Cindex(){
		$categories = Category::all();

		return View('categories.category',compact('categories'));
	}
	public function Cstore(Request $request){
		$request->validate([
		'category_name'=>'unique:categories|required|max:191',
		// 'category_name'=>'numeric',
		]);

		$category = new Category();
		$category->category_name = $request->get('category_name');
		$category->save();

		return redirect()->back()->withSuccess('Category Saved!');
	}

	public function Cedit(Request $request){
		$request->validate([
		'category_name'=>'unique:categories|required|max:191',
		]);

		$category = Category::findOrFail($request->id);
		$category->category_name = $request->category_name;
		$category->save();

		return redirect()->back()->withSuccess('Category Updated!');
	}

	public function Cdestroy(Request $request){
		$category = Category::findOrFail($request->id);
		$category->delete();

		return redirect()->back()->withSuccess('Category Deleted!');
	}
}
