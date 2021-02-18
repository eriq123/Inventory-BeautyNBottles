<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $lowstocks = Item::whereRaw('item_limit >= item_quantity')->count();

        View::share('lowstocks', $lowstocks);
    }
}
