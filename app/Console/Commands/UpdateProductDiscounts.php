<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\PromotionController;

class UpdateProductDiscounts extends Command
{
    protected $signature = 'promotions:update-discounts';
    protected $description = 'Update product discounts based on active promotions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new PromotionController();
        $controller->updateProductDiscounts();
    }
}
