<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ExamenGruposTableSeeder::class);
        $this->call(ExamenTiposTableSeeder::class);
        $this->call(ExamenEstadosTableSeeder::class);
    }
}
