<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'owner_id', 'car_model_id', 'address_id', 'vehicle_fuel_type',
        'vehicle_seat_count',
        'vehicle_gear_box_type', 'vehicle_door_count', 'vehicle_registration',
        'Vehicle_identification_number', 'mileage', 'color', 'status',
        'description_of_feature',
        'currency',
        'price',
        'white_book',
        'tax_clearancy',
        'last_insurancy',
        'cover_image',
        'front_car_image',
        'car_left_side',
        'car_right_side',
        'car_behind_image',
        'dashbooard_image',
        'inside_image',
        'pomo_code',
    ];



    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function sold()
    {
        return $this->hasOne(CarSold::class);
    }
}
