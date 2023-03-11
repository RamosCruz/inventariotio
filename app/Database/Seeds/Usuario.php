<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario extends Seeder
{
    public function run()
    {
        $usuario = "agraria";
        $password = password_hash("agr2023", PASSWORD_DEFAULT);
        $type = "farmacia";
        $data = [
            'usuario' => $usuario,
            'password'    => $password,
            'type'    => $type,
        ];

        // Using Query Builder
        $this->db->table('t_usuarios')->insert($data);

        //crear usuario desde terminal php spark db:seed usuario
    }
}
