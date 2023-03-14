<?php

namespace App\Controllers;
    use App\Models\Usuarios;
    use App\Models\Consultas;
    use CodeIgniter\Files\File;
class Home extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        $mensaje = session('Hola soy Luis');
        return view('login',["mensaje"=>$mensaje]);
    }
    public function inicio()
    {
        /*$json = file_get_contents(base_url('assets/datos/csvjson.json'));
        $obj = json_decode($json);
        $data['json'] = $obj;*/

        $consulta= new Consultas();
        $obj = $consulta->obtenerDatos();
        //$obj2 = $consulta->getFamilias();
        $data['json'] = $obj;
        $data['errors'] = [];
        return view('inicio',$data);
    }
    public function login()
    {
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $Usuario= new Usuarios();
        $datosUsuario = $Usuario->obtenerUsuario(['usuario'=>$usuario]);

        if(count($datosUsuario)>0 && password_verify($password,$datosUsuario[0]['password'])){
            $data = [
                "usuario"=> $datosUsuario[0]['usuario'],
                "type"=> $datosUsuario[0]['type'],
            ];
            $session = session();
            $session->set($data);
            return redirect()->to(base_url('/inicio'))->with('messaje','1');
        }else {
            return redirect()->to(base_url('/'))->with('messaje','0');
        }

    }
    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
    public function cambiar()
    {
        $id = [
            'codigo' => $this->request->getPost('codigo')
        ];
        $contiene = $this->request->getPost('contiene');
        if($contiene==null){
            $setData = [
                'facturasyremisiones' => $this->request->getPost('facturasyremisiones'),
                'agraria' => $this->request->getPost('agraria'),
                'bodega' => $this->request->getPost('bodega'),
                'sumatotal' => $this->request->getPost('sumatotal'),
                'existencia' => $this->request->getPost('existencia'),
                'diferencia' => $this->request->getPost('diferencia'),
                'nota' => $this->request->getPost('nota')
            ];
        }else{
            $setData = [
                'facturasyremisiones' => $this->request->getPost('facturasyremisiones'),
                'contiene' => $contiene,
                'e' => $this->request->getPost('e'),
                'f' => $this->request->getPost('f'),
                'g' => $this->request->getPost('g'),
                'h' => $this->request->getPost('h'),
                'j' => $this->request->getPost('j'),
                'piezas' => $this->request->getPost('piezas'),
                'agraria' => $this->request->getPost('agraria'),
                'bodega' => $this->request->getPost('bodega'),
                'sumatotal' => $this->request->getPost('sumatotal'),
                'existencia' => $this->request->getPost('existencia'),
                'diferencia' => $this->request->getPost('diferencia'),
                'nota' => $this->request->getPost('nota')
            ];
        }
        
        
        $consulta= new Consultas();
        $obj = $consulta->actualizarDatos($id,$setData);

        echo $obj;
    }

    public function upload()
    {
        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();

            //$data = ['uploaded_fileinfo' => new File($filepath)];

            //print($filepath);
            $file = fopen($filepath, 'r');
            while (($line = fgetcsv($file)) !== FALSE) {
            $reg = [
                "codigo"=>$line[0],
                "familia"=>$line[1],
                "descripcion"=>$line[2],
                'facturasyremisiones' => 0,
                'agraria' => 0,
                'bodega' => 0,
                'bodega' => 0,
                'contiene' => 0,
                'e' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'j' => 0,
                'piezas' => 0,
                'sumatotal' => 0,
                "existencia"=>$line[3],
                "diferencia"=>$line[3]//((int)$line[3]-2*((int)$line[3]))
            ];

            $myArray[] =$reg;
            
            }
            array_shift($myArray);
            unlink($filepath);
            $consulta= new Consultas();
            $obj = $consulta->actualizarTabla($myArray);
            fclose($file);
            //echo $obj;
            return redirect()->to(base_url('/inicio'))->with('messaje','1');
        }

        //$data = ['errors' => 'The file has already been moved.'];

        //return view('upload_form', $data);
    }
    public function historial()
    {
        return view('historial');
    }
    public function existehistorial(){
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date("d-m-Y");
        $consulta= new Consultas();
        $obj = $consulta->selecthistorial($fechaActual);
        echo json_encode($obj);
    }
    public function guardarhistorial()
    {
        
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date("d-m-Y");
        $consulta= new Consultas();
        $obj = $consulta->obtenerDatos();
        $jsonres = json_encode($obj);
        $setData = [
            'fecha' => $fechaActual,
            'jsonres' => $jsonres
        ];
        $consulta2= new Consultas();
        $obj2 = $consulta2->sethistorial($setData);

        echo json_encode($obj2);
    }
    public function actualizarhistorial()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date("d-m-Y");
        $consulta= new Consultas();
        $obj = $consulta->obtenerDatos();
        $jsonres = json_encode($obj);
        $fecha = [
            'fecha' => $fechaActual
        ];
        $setData = [
            'jsonres' => $jsonres
        ];
        $consulta2= new Consultas();
        $obj2 = $consulta2->updatehistorial($fecha,$setData);

        echo json_encode($obj2);
    }

}
