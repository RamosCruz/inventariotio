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
        public function actualizarDatos($id,$setData){
            $builder = $this->db->table('t_inventario');
            $builder->set($setData);
            $builder->where($id);
            $builder->update();
            if ($this->db->affectedRows() > 0)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        public function getFamilias(){
            $builder = $this->db->table('t_inventario');
            $builder->distinct();
            $builder->select('familia');
            $builder->orderBy('familia','ASC');
            return $builder->get()->getResultArray();

        }
    }
?>