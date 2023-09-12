<?php

//namespace App\Libraries\fpdf; //llmamos a la nombre de espacio "Libraries"
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\CajasModel;
use App\Models\RolesModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //LA COMENTAMOS YA QUE NO LA ESTAMOS UTILIZANDO
use PhpOffice\PhpSpreadsheet\IOFactory;
//Llmando a los métodos y funciones de la librería phpOfice
//que se encuentran en la la carpeta libreries.
//require 'vendor/autoload.php';

use FPDF; //
require_once APPPATH . '/Libraries/fpdf/fpdf.php';


class Usuarios extends BaseController
{

    protected $usuarios, $cajas, $roles;
    protected $reglas, $reglasLogin, $reglasCambia;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
        $this->cajas = new CajasModel();
        $this->roles = new RolesModel();




        /*ESTE ARREGLO CUMPLE LA FUNCIÓN DE QUE LOS CAMPOS SEAN OBLIGATORIOS EN ESTE MÓDULO*/
        helper(['form']);
        $this->reglas = [
            'usuario' =>
            [
                'rules' => 'required|is_unique[usuarios.usuario]', 'errors' =>
                [
                    'required' => 'El CAMPO  ususario ES OBLIGATORIO!!',
                    'is_unique' => 'El USUARIO ya existe!!'
                ]
            ],

            'password' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'El CAMPO password ES OBLIGATORIO!!']],

            're_password' =>
            ['rules' => 'required|matches[password]', 'errors' =>
            [
                'required' => 'El CAMPO  re pasword ES OBLIGATORIO!!',
                'matches' => 'LAS CONTRASEÑAS NO COINCIDEN!!'
            ]],


            //'nombre' =>
            //['rules' => 'required', 'errors' =>
            //['required' => 'El CAMPO  nombre ES OBLIGATORIO!!']],


            'id_caja' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'El CAMPO  caja  ES OBLIGATORIO!!']],

            'id_rol' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'El CAMPO  rol ES OBLIGATORIO!!']]
        ];

        /*ESTE ARREGLO ES PARA VALIDAR EL INICIO DE SESSIÓN DEL LOGIN*/
        $this->reglasLogin = [
            'usuario' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'EL USUARIO Y/O CONTRASEÑA SON INCORRECTOS']],

            //'password' =>
            //['rules' => 'required', 'errors' =>
            //[
            'required' => 'El CAMPO  re pasword ES OBLIGATORIO!!'
            //]]
        ];


        /*VALIDACION PARA LOS CAMPOS CONTRASEÑA*/
        $this->reglasCambia = [
            'password' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'El CAMPO ES OBLIGATORIO!!']],

            're_password' =>
            ['rules' => 'required|matches[password]', 'errors' =>
            [
                'required' => 'El CAMPO  re pasword ES OBLIGATORIO!!',
                'matches' => 'LAS CONTRASEÑAS NO COINCIDEN!!'
            ]]
        ];
    }

    public function index($activo = 1)
    {


        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Usuarios', 'datos' => $usuarios];

        echo view('header');
        echo view('usuarios/usuarios', $data);
        echo view('footer');
    }



    public function eliminados($activo = 0)
    {
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Usuarios-Eliminados', 'datos' => $usuarios];
        echo view('header');
        echo view('usuarios/eliminados', $data);
        echo view('footer');
    }


    public function nuevo()
    {
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $roles = $this->roles->where('activo', 1)->findAll();

        $data = ['titulo' => 'Agregar Usuarios', 'cajas' => $cajas, 'roles' => $roles];
        echo view('header');
        echo view('usuarios/nuevo', $data);
        echo view('footer');
    }


    public function correo()
    {
        $asunto = $this->request->getPost('nombre');
        $mensaje = $this->request->getPost('password');
        $correo = $this->request->getPost('usuario');


        $email = \Config\Services::email();

        $email->setFrom('ferreteri@example.com', 'Empresa');
        $email->setTo($correo);
        //$email->setCC('another@another-example.com');
        //$email->setBCC('them@their-example.com');

        $email->setSubject($asunto);
        $email->setMessage($mensaje);

        $email->send();

        echo view('header');
        echo view('usuarios/nuevo');
        echo view('footer');
    }

    public function pdf()
    {

        // Cargar el modelo de la base de datos y recuperar los datos que desees
        $usuarioModel = new \App\Models\ClientesModel();
        $data['clientes'] = $usuarioModel->findAll();

        // Crear un nuevo objeto FPDF
        $pdf = new FPDF();

        $pdf->AddPage();

        // Establecer el título del documento
        $pdf->SetTitle('Listado de Usuarios');

        // Configurar fuente y tamaño de texto
        $pdf->SetFont('Arial', 'B', 12);

        // Agregar título
        $pdf->Cell(0, 10, 'Listado de Usuarios', 0, 1, 'C');
       
        $pdf->Cell(20, 10, 'Nombre', 1);
        $pdf->Cell(90, 10, 'direccion', 1);
        $pdf->Cell(30, 10, 'telefono', 1);
        $pdf->Cell(40, 10, 'correo', 1);
        $pdf->Ln(); 
       

        // Crear el contenido del PDF
        foreach ($data['clientes'] as $usuario) {
          
            $pdf->Cell(20, 10, $usuario['nombre'], 1);
            $pdf->Cell(90, 10, $usuario['direccion'], 1);
            $pdf->Cell(30, 10, $usuario['telefono'], 1);
            $pdf->Cell(40, 10, $usuario['correo'], 1);
            $pdf->Ln();
        }

        // Salida del PDF (puedes guardar o mostrar en el navegador)
        $pdf->Output('listado_usuarios.pdf', 'I'); // 'I' para mostrar en el navegador, 'F' para guardar en un archivo

        exit();
    }


    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Hello World !');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="miexcel.xls"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');

        //DE ESTA FORMA LE DECIMOS QUE LA DESCARGA SE HAGA EN EL OREDENADOR
        $writer->save('php://output');


        //$writer = new Xlsx($spreadsheet);
        //$writer->save('hello world.xlsx');

        //echo view('usuarios/excel');

    }


    public function insertar()
    {
        //$letras = "1234567890qwertyuiop+asdfghjklzxcvbnm-QWERTYUIOPASDFGHJKLZXCVBNM";
        //$tamanio = 6;

        //$generado=substr(str_shuffle($letras),0,$tamanio);
        $contra = $this->request->getPost('password');


        //$contra = $this->request->getPost('password');
        $cadenaUno = strval($contra);

        if ($this->request->getPost() && $this->validate($this->reglas)) {

            $this->usuarios->save([
                'usuario' => $this->request->getPost('usuario'),
                'password' => password_hash($cadenaUno, PASSWORD_BCRYPT, ['cost' => 5]),
                'nombre' => $this->request->getPost('nombre'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
                'activo' => 1
            ]);

            $asunto = $this->request->getPost('nombre');
            $mensaje = $this->request->getPost('password');
            $correo = $this->request->getPost('usuario');

            $email = \Config\Services::email();

            $email->setFrom('ferreteri@example.com', 'Empresa');
            $email->setTo($correo);
            //$email->setCC('another@another-example.com');
            //$email->setBCC('them@their-example.com');

            $email->setSubject($asunto);
            $email->setMessage($mensaje);

            $email->send();


            return redirect()->to(base_url() . '/usuarios');
        } else {
            $cajas = $this->cajas->where('activo', 1)->findAll();
            $roles = $this->roles->where('activo', 1)->findAll();

            $data = ['titulo' => 'Agregar-Usuarios', 'cajas' => $cajas, 'roles' => $roles, 'validation' => $this->validator];
            echo view('header');
            echo view('usuarios/nuevo', $data);
            echo view('footer');
        }
    }


    public function editar($id, $valid = null)
    {

        $unidad = $this->usuarios->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar Usuario', 'datos' => $unidad, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar Usuario', 'datos' => $unidad];
        }


        //$session = session();

        //print_r($user_sesion->nombre);

        echo view('header');
        echo view('usuarios/editar', $data);
        echo view('footer');
    }


    public function actualizar()
    {
        if ($this->request->getPost() && $this->validate($this->reglas)) {
            $this->usuarios->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto')
            ]);

            return redirect()->to(base_url() . '/usuarios');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }


    public function eliminar($id)
    {
        $this->usuarios->update($id, ['activo' => 0]);

        return redirect()->to(base_url() . '/usuarios');
    }


    public function reingresar($id)
    {
        $this->usuarios->update($id, ['activo' => 1]);

        return redirect()->to(base_url() . '/usuarios');
    }

    public function login()
    {
        echo view('login');
    }


    //realizar nueva mente un nuevo login - puede que sea las llaves foraneas


    public function valida()
    {
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $cadena = strval($password);


        $datosUsuario = $this->usuarios->where('usuario', $usuario)->first();

        if ($this->usuarios->where('usuario', $usuario)->first()) {


            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('usuario', $usuario)->first();
            $cadena = strval($password);

            if (password_verify($cadena, $datosUsuario['password'])) {

                $datosSession =
                    [
                        'id_usuario' => $datosUsuario['id'],
                        'nombre' => $datosUsuario['nombre'],
                        'usuario' => $datosUsuario['usuario'],
                        'id_caja' => $datosUsuario['id_caja'],
                        'id_rol' => $datosUsuario['id_rol']
                    ];

                $session = session();
                $session->set($datosSession);

                return redirect()->to(base_url() . '/unidades'); //unidades
            } else {
                $data['error'] = "EL USUARIO Y/O CONTRASEÑA SON INCORRECTOS";
                echo view('login', $data);
            }
        } else {
            $data['error'] = "EL USUARIO Y/O CONTRASEÑA SON INCORRECTOS";
            echo view('login', $data);
        }

        //ES MUY IMPORTANTE VER CUANDO DECLARAR O NO UN AVARIABLE DENTRO DE UNA 
        //CONDICIÓN "EN ESTE CASO LA DECLARACIÓN DE VARIABLE SOLO $DATOSUSUSARIO"
        //NOS MARCABA UN ERROR, SE PROCEDIÓ A QUITAR LA VARIABLE Y FUNCIONÓ CORRECTAMENTE.
        //&& $this->usuarios->where('usuario', $usuario)->first()


    }




    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url());
    }

    public function cambia_pasword()
    {
        //$session = session();

        $usuario = $this->usuarios->where('activo', 1)->first();
        //$usuario = $this->usuarios->where('usuario', $session->id_usuario)->first();
        $data = ['titulo' => 'Cambiar Cntraseña', 'usuario' => $usuario];

        echo view('header');
        echo view('usuarios/cambia_pasword', $data);
        echo view('footer');
    }


    public function actualiza_pasword()
    {
        $password = $this->request->getPost('password');
        $cadena = strval($password);


        if ($this->request->getPost() && $this->validate($this->reglasCambia)) {
            $session = session();
            $idUsuario = $session->id_usuario;

            $this->usuarios->update($idUsuario, ['password' => password_hash($cadena, PASSWORD_BCRYPT)]);
            //$encrypter = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
            $usuario = $this->usuarios->where('activo', 1)->first();
            $data = ['titulo' => 'Cambiar Cntraseña', 'usuario' => $usuario, 'validation' => $this->validator];

            echo view('header');
            echo view('usuarios/cambia_pasword', $data);
            echo view('footer');

            return redirect()->to(base_url() . '/usuarios');
        } else {

            $usuario = $this->usuarios->where('activo', 1)->first();
            //$usuario = $this->usuarios->where('usuario', $session->id_usuario)->first();
            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'validation' => $this->validator];

            echo view('header');
            echo view('usuarios/cambia_pasword', $data);
            echo view('footer');
        }
    }
}
