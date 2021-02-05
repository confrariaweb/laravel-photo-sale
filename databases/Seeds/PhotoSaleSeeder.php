<?php

namespace ConfrariaWeb\PhotoSale\Databases\Seeds;

use ConfrariaWeb\PhotoSale\Models\OrderStatus;
use ConfrariaWeb\PhotoSale\Models\Plan;
use Illuminate\Database\Seeder;

class PhotoSaleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        OrderStatus::firstOrCreate(
            ['name' => 'Aguardando pagamento']
        );

        Plan::firstOrCreate([
            'name' => 'Plano 001',
            'price' => '14.50',
            'description' => 'Voce uma unica vez 12 fotos polaroid na sua casa.',
            'photo_amount' => '12',
            'photo_type' => 'Polaroid',
            'recurrent' => false
        ]);
        Plan::firstOrCreate([
            'name' => 'Plano 002',
            'price' => '24.50',
            'description' => 'Voce recebe todos os meses 24 fotos polaroid na sua casa.',
            'photo_amount' => '24',
            'photo_type' => 'Polaroid',
            'recurrent' => true
        ]);
        Plan::firstOrCreate([
            'name' => 'Plano 003',
            'price' => '34.50',
            'description' => 'Voce recebe todos os meses 36 fotos polaroid na sua casa.',
            'photo_amount' => '36',
            'photo_type' => 'Polaroid',
            'recurrent' => true
        ]);
        Plan::firstOrCreate([
            'name' => 'Plano 004',
            'price' => '44.50',
            'description' => 'Voce recebe todos os meses 48 fotos polaroid na sua casa.',
            'photo_amount' => '48',
            'photo_type' => 'Polaroid',
            'recurrent' => true
        ]);
    }

}