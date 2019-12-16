<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class slr_log extends Model
{
	protected $table = 'slr_logs';

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d/Y - H:i');
    }
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i - m/d/Y');
    }

    // total
    public function getTotalAttribute($total)
    {
        return $total / 100;
    }

    public function setTotalAttribute($total)
    {
        $this->attributes['total'] = $total * 100;
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
