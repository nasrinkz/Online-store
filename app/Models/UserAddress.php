<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','address','city_id','province_id','zipCode'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'address' => 'Nothing added.'
        ]);
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
