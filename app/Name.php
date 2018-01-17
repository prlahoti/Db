<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    //
    function scopePAttendance($query)
    {
    	$query->where('attendance',1);
    }
    function scopeAAttendance($query)
    {
    	$query->where('attendance',0);
    }
}
