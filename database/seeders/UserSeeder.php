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
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'tipoDocumento' => 'Cedula de Ciudadania',
            'numDocumento' => 1007158682,
            'nombreU' => 'Diego Alejandro',
            'apellidoU' => 'Santana Lizarazo',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('Admin');
    }
}
