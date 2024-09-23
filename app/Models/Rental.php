<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id', 'customer_id', 'start_date', 'end_date', 'status'
    ];

    public function car()
{
    return $this->belongsTo(Car::class);
}


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function owner()
    {
        return $this->car->owner;
    }

    public function durationInDays()
    {
        // Ensure that start_date and end_date are Carbon instances
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        // Calculate and return the difference in days
        return $start->diffInDays($end);
    }
}
