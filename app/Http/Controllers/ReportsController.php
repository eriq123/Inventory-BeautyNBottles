<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\slr_log;
use App\Item;
use Carbon\Carbon;

class ReportsController extends Controller
{
	public function Rindex(){
		$now = Carbon::now();
		$weekbefore = Carbon::now()->subDays(7);

		$reports_array = slr_log::whereBetween('created_at',[$weekbefore,$now])->get();
		$items = Item::all();

		$reports = [];
		$totals = [];
		$sale = [];
		$loss = [];
		$name = [];
		$rts = [];

		foreach ($reports_array as $report_array) {
			$reports[] = $report_array->item_id;
		}

		foreach ($items as $item) {

			if (in_array($item->id, $reports)) {
				// compute total
				$total = 0;
				$report_items_totals = slr_log::where('item_id',$item->id)->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_totals as $report_items_total) {
					$total += $report_items_total->total;
				}
				// compute sales
				$sales = 0;
				$report_items_sales = slr_log::where([['item_id',$item->id],['status','Sales']])->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_sales as $report_items_sale) {
					$sales += $report_items_sale->total;
				}
				// compute losses
				$losses = 0;
				$report_items_losses = slr_log::where([['item_id',$item->id],['status','Loss']])->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_losses as $report_items_loss) {
					$losses += $report_items_loss->total;
				}
				// compute RTS
				$rtss = 0;
				$report_items_rtss = slr_log::where([['item_id',$item->id],['status','RTS']])->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_rtss as $report_items_rts) {
					$rtss += $report_items_rts->total;
				}

				array_push($totals, $total);
				array_push($rts, $rtss);
				array_push($sale, $sales);
				array_push($loss, $losses);
				array_push($name, $item->item_name);
			} //end if
		} //end foreach items

		// count all distinct item/s in report
		$TotalReports = count($name);

		// get grandtotal
		$GrandTotalSales = 0;
		$GrandTotalLosses = 0;
		$GrandTotalRTS = 0;
		for ($i=0; $i < $TotalReports; $i++) { 
			$GrandTotalSales += $sale[$i];
			$GrandTotalLosses += $loss[$i];
			$GrandTotalRTS += $rts[$i];
		}

		// return dd([$reports,$sale,$loss,$rts,$name]);

		return view('reports.index',compact('name','sale','loss','GrandTotalSales','GrandTotalLosses','GrandTotalRTS','TotalReports','weekbefore','now','rts'));
	}






	public function Rdownload(){
		$now = Carbon::now();
		$weekbefore = Carbon::now()->subDays(7);

		$reports_array = slr_log::whereBetween('created_at',[$weekbefore,$now])->get();
		$items = Item::all();

		$reports = [];
		$totals = [];
		$sale = [];
		$loss = [];
		$name = [];
		$rts = [];

		foreach ($reports_array as $report_array) {
			$reports[] = $report_array->item_id;
		}

		foreach ($items as $item) {

			if (in_array($item->id, $reports)) {
				// compute total
				$total = 0;
				$report_items_totals = slr_log::where('item_id',$item->id)->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_totals as $report_items_total) {
					$total += $report_items_total->total;
				}
				// compute sales
				$sales = 0;
				$report_items_sales = slr_log::where([['item_id',$item->id],['status','Sales']])->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_sales as $report_items_sale) {
					$sales += $report_items_sale->total;
				}
				// compute losses
				$losses = 0;
				$report_items_losses = slr_log::where([['item_id',$item->id],['status','Loss']])->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_losses as $report_items_loss) {
					$losses += $report_items_loss->total;
				}
				// compute RTS
				$rtss = 0;
				$report_items_rtss = slr_log::where([['item_id',$item->id],['status','RTS']])->whereBetween('created_at',[$weekbefore,$now])->get();
				foreach ($report_items_rtss as $report_items_rts) {
					$rtss += $report_items_rts->total;
				}

				array_push($totals, $total);
				array_push($rts, $rtss);
				array_push($sale, $sales);
				array_push($loss, $losses);
				array_push($name, $item->item_name);
			} //end if
		} //end foreach items

		// count all distinct item/s in report
		$TotalReports = count($name);

		// get grandtotal
		$GrandTotalSales = 0;
		$GrandTotalLosses = 0;
		for ($i=0; $i < $TotalReports; $i++) { 
			$GrandTotalSales += $sale[$i] - $rts[$i];
			$GrandTotalLosses += $loss[$i];
		}
		// return view('reports.download',compact('name','sale','loss','GrandTotalSales','GrandTotalLosses','TotalReports','weekbefore','now','rts'));

		// return view('reports.download');	
		// return dd($weekbefore);
		$data = [
		'weekbefore' => $weekbefore,
		'name'=>$name,
		'sale'=>$sale,
		'loss'=>$loss,
		'GrandTotalSales'=>$GrandTotalSales,
		'GrandTotalLosses'=>$GrandTotalLosses,
		'TotalReports'=>$TotalReports,
		'now'=>$now,
		'rts'=>$rts,];
		// return dd($data);
		$pdf = PDF::loadView('reports.download',$data);
		return $pdf->stream('reports.pdf');
	}

	public function Rcreate(){

		return view('',compact(''));
	}

}
