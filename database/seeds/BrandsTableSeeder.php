<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = config('database_seeder.brands');
        foreach ($brands as $brand) {
            $marca = \App\Models\Brand::create([
                'name' => $brand['name'],
            ]);
            $this->command->info('Creating Brand '.$brand['name']);
        }
    }
}
