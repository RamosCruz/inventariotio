<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario extends Seeder
{
    public function run()
    {
        $usuario = "leo";
        $password = password_hash("alm23", PASSWORD_DEFAULT);
        $type = "almacen";
        $data = [
            'usuario' => $usuario,
            'password'    => $password,
            'type'    => $type,
        ];

        // Using Query Builder
        $this->db->table('t_usuarios')->insert($data);
    }
}
