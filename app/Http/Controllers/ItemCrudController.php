<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Item;
use App\Category;
use App\Sub_Category;
use Response;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ItemCrudController extends Controller
{
    public function ICindex(){
    	$categories = Category::all();
    	$sub_categories = Sub_Category::all();
    	$items = Item::all();
    	return view('items.index', compact('categories','sub_categories','items'));
    }

    public function ICstore(Request $request){
		$request->validate([
		'quantity'=>'integer',
		'limit'=>'integer',
		'selling_price'=>'numeric',
		'purchase_price'=>'numeric',
		'image'=>'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
		]);

		if ($request->get('action') == "Update") {
			$item = Item::findorFail($request->get('id'));
		}else {
			$item = new Item();
		}

		// image upload
		if(!empty($request->file('image'))){
	        $attachment = $request->file('image');
	        $current = Carbon::now()->format('YmdHs');

	    	$extension = $attachment->getClientOriginalExtension();
	        $filename = Auth::user()->id.'-'.$current.'-'.$attachment->getClientOriginalName();
	   		Storage::disk('public')->put($filename,  File::get($attachment));
	        
	   		if ($request->get('action') == "Update") {
	   			// if ($item->item_image !== null) {
			   		if ($filename !== $item->item_image) {
						Storage::disk('public')->delete($item->item_image);
			   		}
		   		// }
	   		}
		}else{
			$filename = $item->item_image;
		}

		$item->item_name = $request->get('item_name');
		$item->item_description = $request->get('item_description');
		$item->category_id = $request->get('category');
		$item->sub_category_id = $request->get('sub_category');
		$item->item_quantity = $request->get('quantity');
		$item->item_unit = $request->get('unit');
		$item->item_limit = $request->get('limit');
		$item->selling_price = $request->get('selling_price');
		$item->purchase_price = $request->get('purchase_price');
		// insert save image code here
		$item->item_image = $filename;
		$item->save();
		// return response()->json([$item,$filename]);

		if ($request->get('action') == "Update") {
			return redirect()->route('item.index')->withSuccess('Product Saved!');
		}else{
			return redirect()->back()->withSuccess('Product Saved!');
		}
    }

    public function ICedit($id){
    	$item = Item::findorFail($id);
    	$categories = Category::all();
    	$sub_categories = Sub_Category::where('category_id',$item->category_id)->get();

    	return view('items.edit', compact('categories','sub_categories','item'));
    }

    public function ICdestroy(Request $request){
    	$item = Item::findorFail($request->id);
		Storage::disk('public')->delete($item->item_image);
    	$item->delete();

		return redirect()->back()->withSuccess('Product Deleted!');
    }
    public function ICdropdown(Request $request){
        $input = $request->input('option');
        $sub_categories = Sub_Category::sub_category($input);

        return Response::json(compact('sub_categories'));
    }
}
