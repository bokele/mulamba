<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use SoftDeletes;
    protected $fillable = ['brand', 'model',  'vehicle_type', 'year'];

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
