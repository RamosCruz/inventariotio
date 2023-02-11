<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario extends Seeder
{
    public function run()
    {
        $usuario = "marissa";
        $password = password_hash("c0nt23", PASSWORD_DEFAULT);
        $type = "contabilidad";
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
