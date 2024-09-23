<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rental;
use App\Models\Car;
use App\Mail\EndingRentalNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class SendRentalEndEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:sendRentalEnd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications when a rental end date matches the current date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $rentals = Rental::whereDate('end_date', $today)->get();

        $id = $rentals->car_id;
        $car = Car::where('id', $id);
        $car->availabilty_status = '1';
        foreach ($rentals as $rental) {
            $owner = $rental->car->owner;
            $customer = $rental->customer;

            Mail::to($owner->email)->send(new EndingRentalNotification($rental, $owner));

            Mail::to($customer->email)->send(new EndingRentalNotification($rental, $customer));

            $this->info("Emails sent for rental ID: {$rental->id}");
        }
    }
}
