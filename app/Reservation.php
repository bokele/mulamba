<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'pick_up_location_id', 'drop_off_location_id', 'customer_id',
        'car_id',
        'start_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function pickUpLocation()
    {
        return $this->belongsTo(CAddressar::class, 'pick_up_location_id', 'id');
    }

    public function dropOffLocation()
    {
        return $this->belongsTo(Address::class, 'drop_off_location_id', 'id');
    }
}
