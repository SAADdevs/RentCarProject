<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'model', 'year', 'status', 'availability_status', 'description', 'price_per_day', 'image_url', 'car_id','city'   ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
