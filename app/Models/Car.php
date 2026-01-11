<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'odometer_current',
        'odometer_previous',
        'date_previous'
    ];
    
}
