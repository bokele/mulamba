<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',  'car_id', 'pick_up_location_id', 'drop_of_location_id',
        'fuel_litter', 'start_date', 'end_date', 'remarque'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(User::class, 'car_id', 'id');
    }
}
