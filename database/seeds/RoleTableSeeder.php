<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'superadmin','display_name'=> 'Super Administrador', 'description'=> 'Usuario gerente gcarga'],
            ['name' => 'administrador','display_name'=> 'Administrador', 'description'=> 'Usuario gerente administrativo del gcarga'],
            ['name' => 'empresa','display_name'=> 'Empresa', 'description'=> 'Usuario empresa de la aplicacion web'],
            ['name' => 'conductor','display_name'=> 'Conductor', 'description'=> 'Usuario conductor del la web y app'],
            ['name' => 'cliente','display_name'=> 'Cliente', 'description'=> 'Usuario cliente de la web y app']
        ]);
    }
}
