<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class WeightBulkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weights = config('database_seeder.weights');
        $bulks = config('database_seeder.bulks');
        foreach ($weights as $weight) {
            $peso = \App\Models\Weight::create([
                'weight' => $weight['weight'],
                'registered_by' => $weight['registered_by']
            ]);
            $this->command->info('Creating Weights '. $weight['weight']);
        }
        foreach ($bulks as $bulk) {
            $peso = \App\Models\Bulk::create([
                'bulk' => $bulk['bulk'],
                'registered_by' => $bulk['registered_by']
            ]);
            $this->command->info('Creating Bulks '. $bulk['bulk']);
        }
    }
}
