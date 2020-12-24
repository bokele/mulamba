<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'flag', 'code', 'currency'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
