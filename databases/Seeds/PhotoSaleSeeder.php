<?php

namespace ConfrariaWeb\PhotoSale\Databases\Seeds;

use ConfrariaWeb\PhotoSale\Models\OrderStatus;
use ConfrariaWeb\PhotoSale\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PhotoSaleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $orderStatuses = config('cw_photo_sale.order.statuses');
        foreach ($orderStatuses as $status) {
            $status['slug'] = Str::slug($status['slug']);
            OrderStatus::firstOrCreate($status);
        }

        $plans = config('cw_photo_sale.plans');
        foreach ($plans as $plan) {
            Plan::firstOrCreate($plan);
        }


    }

}