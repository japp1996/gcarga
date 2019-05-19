<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModeloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = config('database_seeder.models');
        foreach ($models as $model) {
            $modelo = \App\Models\Modelo::create([
                'name' => $model['name'], 
                'brand_id' => $model['brand_id']
            ]);
            $this->command->info('Creating Model '. $model['name']);
        }
    }
}
