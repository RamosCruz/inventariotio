<?php namespace App\Models;
    use CodeIgniter\Model;

    class Consultas extends Model{
        public function obtenerDatos(){
            //$datos= $this->db->table('t_inventario');
            $builder = $this->db->table('t_inventario');
            $builder->orderBy('familia', 'ASC');
            $builder->orderBy('descripcion', 'ASC');
            return $builder->get()->getResultArray();
        }
    }
?>