<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class UpdateReservationExpDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-reservation-exp-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update exp_date untuk reservations jika ada buku yang tersedia';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pendingReservations = Reservation::with('book')
            ->whereNull('exp_date')
            ->where('status', 'pending')
            ->get();

        foreach ($pendingReservations as $reservation) {
            if ($reservation->book->available_copies > 0) {
                $reservation->exp_date = Carbon::now()->addDay();
                $reservation->save();

                $this->info("Reservation {$reservation->id} updated with exp_date: {$reservation->exp_date}");
            }
        }

        return 0;
    }
}
