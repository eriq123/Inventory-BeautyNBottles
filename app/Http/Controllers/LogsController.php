<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slr_log;
use App\Item;
use Illuminate\Support\Str;
class LogsController extends Controller
{
    public function Lindex(){
    	$logs = slr_log::all();

    	return view('logs.index',compact('logs'));
    }

    public function Lundo(Request $request){
        $request->validate(
            [
                'RemainingStock' => 'gte:quantity',
            ],
            [
                'RemainingStock.gte' => 'Transaction failed. The remaining stock is too low.',
            ]
        );

    	$logs = slr_log::findorFail($request->get('id'));
    	$logs->status = $request->get('action') ." Undo";
    	$logs->save();

    	$item = Item::findorFail($logs->item_id);
		//add stocks
    	// logic:minus stock
    	if ($request->get('action') == "Add Stocks") {
    		$item->item_quantity = $item->item_quantity - $logs->quantity;
    	}
		//sales
    	// minus stock
    	// logic: add stock
    	elseif($request->get('action') == "Sales"){
    		$item->item_quantity = $item->item_quantity + $logs->quantity;
    	}
		//loss
    	// minus stock
    	// logic:add stock
    	elseif($request->get('action') == "Loss"){
    		$item->item_quantity = $item->item_quantity + $logs->quantity;
    	}
		// rts
    	// add stock
    	// logic: minus stock
    	elseif($request->get('action') == "RTS"){
    		$item->item_quantity = $item->item_quantity - $logs->quantity;
    	}
    	$item->save();


    	return redirect()->back()->withSuccess("Logs Updated!");
    	// return dd($logs);
    }

}
