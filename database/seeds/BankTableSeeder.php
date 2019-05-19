<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating Bank, BankUser, Brands, Models and Transport tables');
        $this->truncateBankTables();
        $banks = config('database_seeder.banks');
        foreach ($banks as $bank) {
            $banco = \App\Models\Bank::create([
                'name' => $bank['name'],
                'status' => '1'
            ]);
            $this->command->info('Creating Bank '.$bank['name']);
        }
    }

    public function truncateBankTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('banks')->truncate();
        DB::table('bank_user')->truncate();
        DB::table('brands')->truncate();
        DB::table('models')->truncate();
        DB::table('transports')->truncate();
        \App\Models\Bank::truncate();
        \App\Models\BankUser::truncate();        
        \App\Models\Brand::truncate();
        \App\Models\Modelo::truncate();
        \App\Models\Transport::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
