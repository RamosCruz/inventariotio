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
        public function getFamilias(){//ya no ocupara, lo datos se actulizaran a travez de un csv
            $builder = $this->db->table('t_inventario');
            $builder->distinct();
            $builder->select('familia');
            $builder->orderBy('familia','ASC');
            return $builder->get()->getResultArray();

        }
        public function actualizarTabla($myArray){
            $builder = $this->db->table('t_inventario');
            $builder->emptyTable(); 

            foreach ($myArray as $linea)
            {
                $builder1 = $this->db->table('t_inventario');
                $builder1->insert($linea);
            }

            
            if ($this->db->affectedRows() > 0)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        public function selecthistorial($fecha){
            $builder = $this->db->table('t_historial');
            $builder->where('fecha',$fecha);
            return $builder->get()->getResultArray();
        }
        public function sethistorial($setData){
            $builder1 = $this->db->table('t_historial');
            $builder1->insert($setData);
            if ($this->db->affectedRows() > 0)
            {
                return [true];
            }
            else
            {
                return [false];
            }
        }
        public function updatehistorial($fecha,$setData){
            $builder = $this->db->table('t_historial');
            $builder->set($setData);
            $builder->where('fecha',$fecha);
            $builder->update();
            if ($this->db->affectedRows() > 0)
            {
                return [true];
            }
            else
            {
                return [false];
            }
        }
    }
?>