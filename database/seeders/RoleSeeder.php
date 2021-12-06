<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(["name" => "Developer"]);
        Role::create(["name" => "Superadmin"]);


        $role= Role::create(["name" => "Admin"]);
        $role->syncPermissions(Permission::pluck('name')->toArray());


        /**
         * @var Role $role
         */
        $role= Role::create(["name" => "Medico"]);
        $role->syncPermissions([
            'Ver Examenes',
            'Crear Examenes',
            'Editar Examenes',
            'Eliminar Examenes',
        ]);
        $role->options()->sync([
            12, //mis examenes
            19, //Pacientes
        ]);

        /**
         * @var Role $role
         */
        $role= Role::create(["name" => "Técnico Laboratorio"]);
        $role->syncPermissions([
            'Ver Examenes',
            'Editar Examenes laboratorio',
        ]);

        $role->options()->sync([
            13, //examenes laboratorio
            19, //Pacientes
        ]);





    }
}
