<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'customer_id', 'car_id', 'address_id',
        'status',
        'price', 'propose_price', 'balance', "owner_id", 'message_id', 'owner_id',
        'country_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
    public function message()
    {
        return $this->hasMany(Message::class);
    }
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
