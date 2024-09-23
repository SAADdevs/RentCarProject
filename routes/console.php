<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Artisan;
use App\Models\Rental;

return function (Schedule $schedule) {
    $schedule->command('emails:SendRentalEndEmail')->daily()->when(function () {
        return Rental::whereDate('end_date', now()->toDateString())->exists();
    });
};

