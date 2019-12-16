<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\Sub_Category');
    }

    public function slr_log()
    {
        return $this->hasMany('App\slr_log', 'item_id', 'id');
    }
    
    // selling_price
    public function getSellingPriceAttribute($selling_price)
    {
        return $selling_price / 100;
    }

    public function setSellingPriceAttribute($selling_price)
    {
        $this->attributes['selling_price'] = $selling_price * 100;
    }

    // purchase_price
    public function getPurchasePriceAttribute($purchase_price)
    {
        return $purchase_price / 100;
    }

    public function setPurchasePriceAttribute($purchase_price)
    {
        $this->attributes['purchase_price'] = $purchase_price * 100;
    }

}
