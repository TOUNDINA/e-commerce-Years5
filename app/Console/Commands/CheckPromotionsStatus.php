<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Promotion;
use Carbon\Carbon;

class CheckPromotionsStatus extends Command
{
    protected $signature = 'promotions:check';

    protected $description = 'Check and update promotions status';

    public function handle()
    {
        $now = Carbon::now();

        Promotion::chunk(100, function ($promotions) use ($now) {
            foreach ($promotions as $promotion) {
                if ($promotion->start_date <= $now && $promotion->end_date >= $now) {
                    $promotion->status = true;
                } else {
                    $promotion->status = false;
                }
                $promotion->save();
            }
        });

        $this->info('Promotions status updated successfully.');
    }
}
