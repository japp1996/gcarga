<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TransportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transports = config('database_seeder.transports');
        foreach ($transports as $transport) {
            $transporte = \App\Models\Transport::create([
                'name' => $transport['name'],
                'status' => '1',
                'registered_by' => 1
            ]);
            $this->command->info('Creating Transport '. $transport['name']);
        }
    }
}
