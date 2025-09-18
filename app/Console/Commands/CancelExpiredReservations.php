<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class CancelExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-expired-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel all expired reservations that are still pending';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredReservations = Reservation::where('status', 'pending')
            ->whereNotNull('exp_date')
            ->where('exp_date', '<', now())
            ->get();

        foreach ($expiredReservations as $reservation) {
            $reservation->status = 'canceled';
            $reservation->save();
            $this->info("Reservation {$reservation->id} canceled (expired).");
        }
    }
}
