<?php

namespace App\Controllers;
    use App\Models\Usuarios;
    use App\Models\Consultas;
class Home extends BaseController
{
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
        $obj2 = $consulta->getFamilias();
        $data['json'] = $obj;
        $data['familias'] = $obj2;
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

        $setData = [
            'facturasyremisiones' => $this->request->getPost('facturasyremisiones'),
            'agraria' => $this->request->getPost('agraria'),
            'bodega' => $this->request->getPost('bodega'),
            'sumatotal' => $this->request->getPost('sumatotal'),
            'existencia' => $this->request->getPost('existencia'),
            'diferencia' => $this->request->getPost('diferencia'),
            'nota' => $this->request->getPost('nota')
        ];
        
        $consulta= new Consultas();
        $obj = $consulta->actualizarDatos($id,$setData);

        echo $obj;
    }
}
