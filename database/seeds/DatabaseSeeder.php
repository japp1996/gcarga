<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ModeloTableSeeder::class);
        $this->call(TransportTableSeeder::class);
    }
}
