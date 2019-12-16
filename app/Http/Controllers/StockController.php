<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\slr_log;
use Auth;
use response;
class StockController extends Controller
{
    public function Sindex(){
        $items = Item::all();

        return view('stocks.index',compact('items'));
    }

    public function Sstore(Request $request){
        if ($request->get('action') == "Deduct") {
            $request->validate(
                [
                    'quantity' => 'gte:QuantitytoAddorMinus',
                ],
                [
                    'quantity.gte' => 'Invalid amount entered.',
                ]
            );
        }
        

    	// add quantity
    	$item = Item::findorFail($request->get('id'));

        // if action is add
        if ($request->get('action') == "Add") {
            $item->item_quantity = $item->item_quantity + $request->get('QuantitytoAddorMinus');
        }
        // if action is minus
        elseif($request->get('action') == "Deduct"){
            $item->item_quantity = $item->item_quantity - $request->get('QuantitytoAddorMinus');
        }
        // if action is RTS
        elseif($request->get('action') == "RTS"){
            $item->item_quantity = $item->item_quantity + $request->get('QuantitytoAddorMinus');
        }
        $item->save();


    	// add logs
    	$slrlogs = new slr_log();
        $slrlogs->user_id = Auth::id();
        $slrlogs->item_id = $item->id;
        if ($request->get('Discount') !== null) {
            $slrlogs->discount = $request->get('Discount');
        }else{
            $slrlogs->discount = 0;
        }
    	$slrlogs->quantity = $request->get('QuantitytoAddorMinus');

            // if action is add
            if ($request->get('action') == "Add") {
        	$slrlogs->total = 0;
        	$slrlogs->status = "Add Stocks";
            }
            // if action is minus
            elseif($request->get('action') == "Deduct") {
            $slrlogs->total = ($request->get('QuantitytoAddorMinus') * $item->selling_price) - $request->get('Discount');
            $slrlogs->status = $request->get('SalesLoss');
            }
            // if action is RTS
            elseif($request->get('action') == "RTS") {
            $slrlogs->total = $request->get('QuantitytoAddorMinus') * $item->selling_price;
            $slrlogs->status = "RTS";
            }

    	$slrlogs->save();


    	return redirect()->back()->withSuccess('Quantity Updated!');
    }

    public function Slow(){
        $items = Item::whereRaw('item_limit >= item_quantity')->get();

        return view('stocks.low',compact('items'));
    }
    public function Sreturn(){
        $items = Item::all();

        return view('stocks.return',compact('items'));
    }

    public function Sconvert(){
        $items = Item::all();

        return view('stocks.convert',compact('items'));
    }

    public function CHigh(Request $request){
        if ($request->id) {
            $item = Item::find($request->id);
            $Hitems = Item::where('item_name',$item->item_name)->where('id','!=',$request->id)
            ->with('category')->with('sub_category')
            ->get();
        }
        

        return response()->json(compact('item','Hitems'));
    }

    public function CAction(Request $request){
        // quantity * the conversion
        $TotalQtyToConvert = $request->get('Conversion') * $request->get('Quantity');

        // add the total to low item
        $LowItem = Item::findorFail($request->get('Lid'));
        $LowItem->item_quantity = $LowItem->item_quantity + $TotalQtyToConvert;
        $LowItem->save();

        // deduct the quantity to high item
        $HighItem = Item::findorFail($request->get('Hid'));
        $HighItem->item_quantity = $HighItem->item_quantity - $request->get('Quantity');
        $HighItem->save();

        // save it to logs for the undo button >..<



        // return dd($request->all());
        return redirect()->back()->withSuccess("Stocks Converted!");
    }
}
