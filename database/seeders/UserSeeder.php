<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'sofiaurrego368@gmail.com',
            'username' => 'LCalderon',
            'tipoDocumento' => 'Cedula de Ciudadania',
            'numDocumento' => 1007760581,
            'nombreU' => 'Laura Sofia',
            'apellidoU' => 'Calderon Urrego',
            'password' => bcrypt('contraseña'),
        ]);

        $user->assignRole('Admin');
    }

    
}
