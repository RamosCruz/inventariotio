<?php

namespace App\Controllers;
    use App\Models\Usuarios;
class Home extends BaseController
{
    public function index()
    {
        $mensaje = session('Hola soy Luis');
        return view('login',["mensaje"=>$mensaje]);
    }
    public function inicio()
    {
        $json = file_get_contents(base_url('assets/datos/csvjson.json'));
        $obj = json_decode($json);
        $data['json'] = $obj;
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
}
