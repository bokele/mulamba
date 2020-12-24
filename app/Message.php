<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from', 'to', 'subjecte', 'message',

    ];



    public function from()
    {
        return $this->belongsTo(User::class, 'from', 'id');
    }
    public function to()
    {
        return $this->belongsTo(User::class, 'to', 'id');
    }
    public function message()
    {
        return $this->hasMany(Order::class);
    }
}
