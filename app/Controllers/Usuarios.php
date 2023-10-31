<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    protected $usuarios;
    protected $reglas, $reglasLogin, $reglasCambia;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();



        /*ESTE ARREGLO CUMPLE LA FUNCIÓN DE QUE LOS CAMPOS SEAN OBLIGATORIOS EN ESTE MÓDULO*/
        helper(['form']);
        $this->reglas = [
            'nombreUsuario' =>
            [
                'rules' => 'required|is_unique[usuarios.nombreUsuario]', 'errors' =>
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

            'rol' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'El CAMPO  rol ES OBLIGATORIO!!']]
        ];

        /*ESTE ARREGLO ES PARA VALIDAR EL INICIO DE SESSIÓN DEL LOGIN*/
        $this->reglasLogin = [
            'nombreUsuario' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'El CAMPO ES OBLIGATORIO!!']],

            'rol' =>
            ['rules' => 'required', 'errors' =>
            [
                'required' => 'El CAMPO  rol ES OBLIGATORIO!!'
            ]]
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

    public function index($estado = 1)
    {
        $session = session();
        $rolUsu = $session->rol;
        $rol = "Administrador";

        if ($rolUsu === $rol) {
            $usuarios = $this->usuarios->where('estado', $estado)->findAll();
            $data = ['titulo' => 'Usuarios', 'datos' => $usuarios];

            echo view('header');
            echo view('usuarios/usuarios', $data);
            echo view('footer');
        } else {
            return redirect()->to(base_url() . '/productos');
        }
    }


    public function valida()
    {
        $session = session();
        $rol = $session->rol;

        $rol = "Administrador";
        $usuario = $this->request->getPost('nombreUsuario');

        $datosUsuario = $this->usuarios->where('nombreUsuario', $usuario)->first();

        if ($this->usuarios->where('nombreUsuario', $usuario)->first() && $datosUsuario['rol'] === $rol) {

            $usuario = $this->request->getPost('nombreUsuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('nombreUsuario', $usuario)->first();
            $cadena = strval($password);

            if (password_verify($cadena, $datosUsuario['password'])) {

                $datosSession =
                    [
                        'idUsuario' => $datosUsuario['id'],
                        'nombres' => $datosUsuario['nombres'],
                        'nombreUsuario' => $datosUsuario['nombreUsuario'],
                        'rol' => $datosUsuario['rol']
                    ];

                $session = session();
                $session->set($datosSession);

                return redirect()->to(base_url() . '/usuarios');
            } else {
                return redirect()->to(base_url() . '/usuarios');
            }
        } else {

            $usuario = $this->request->getPost('nombreUsuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('nombreUsuario', $usuario)->first();
            $cadena = strval($password);

            if (password_verify($cadena, $datosUsuario['password'])) {

                $datosSession =
                    [
                        'idUsuario' => $datosUsuario['id'],
                        'nombres' => $datosUsuario['nombres'],
                        'nombreUsuario' => $datosUsuario['nombreUsuario'],
                        'rol' => $datosUsuario['rol']
                    ];

                $session = session();
                $session->set($datosSession);

                return redirect()->to(base_url() . '/productos');
            } else {
                return redirect()->to(base_url() . '/');
            }
        }
    }


    public function insertar()
    {
        $password = $this->request->getVar('password');
        $cadena = strval($password);
        $contrasenaEncriptada = password_hash($cadena, PASSWORD_BCRYPT);
        // Verifica que la solicitud sea una solicitud AJAX
        if ($this->request->isAJAX()) {
            $model = new UsuariosModel();

            // Obtiene los datos enviados por AJAX
            $data = [
                'nombres' => $this->request->getVar('nombres'),
                'primerApellido' => $this->request->getVar('primerApellido'),
                'segundoApellido' => $this->request->getVar('segundoApellido'),
                'nombreUsuario' => $this->request->getVar('nombreUsuario'),
                'password' => $contrasenaEncriptada,
                'rol' => $this->request->getVar('rol'),
                'estado' => 1
            ];

            // Inserta los datos en la base de datos
            $inserted = $model->insert($data);

            if ($inserted) {
                // Devuelve una respuesta JSON de éxito
                return $this->response->setJSON(['message' => 'Registro exitoso']);
            } else {
                // Devuelve una respuesta JSON de error
                return $this->response->setJSON(['message' => 'Error al registrar']);
            }
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);

            // Si no es una solicitud AJAX, redirige o muestra una vista de error
        }
    }



    public function buscar()
    {
        // Devuelve los resultados como JSON
        $this->usuarios = new UsuariosModel();
        $db = \Config\Database::connect();
        $buscare = $this->request->getPost('usuarios');
        $cadena = strval($buscare);
        $builder = $db->table('usuarios');
        $builder->like('usuarios.ciNit', $cadena);
        $builder->where('usuarios.estado', 1);
        $query = $builder->get();
        $usuario = $query->getResult();
        return $this->response->setJSON($usuario);
    }


    public function obtenerDatos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('usuarios.id');
        $builder->select('usuarios.nombres');
        $builder->select('usuarios.primerApellido');
        $builder->select('usuarios.segundoApellido');
        $builder->select('usuarios.nombreUsuario');
        $builder->select('usuarios.password');
        $builder->select('usuarios.rol');
        $builder->where('usuarios.estado', 1);

        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $usuarios = $builder->get();
        $data['usuarios'] = $usuarios->getResult();
        echo json_encode($data);
    }

    public function actualizar()
    {
        if ($this->request->isAJAX()) {
            $this->usuarios->update($this->request->getPost('idUsuario'), [
                'nombres' => $this->request->getPost('nombres'),
                'primerApellido' => $this->request->getPost('primerApellido'),
                'segundoApellido' => $this->request->getPost('segundoApellido'),
                'nobreUsuario' => $this->request->getPost('nobreUsuario'),
                'password' => $this->request->getPost('password'),
                'rol' => $this->request->getPost('rol')

            ]);
            $si = 1;

            if ($si == 1) {
                // Devuelve una respuesta JSON de éxito
                return $this->response->setJSON(['message' => 'Registro exitoso']);
            } else {
                // Devuelve una respuesta JSON de error
                return $this->response->setJSON(['message' => 'Error al registrar']);
            }
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);

            // Si no es una solicitud AJAX, redirige o muestra una vista de error
        }
    }

    public function eliminar()
    {
        //$valor = $this->request->getPost('idProducto');
        if ($this->request->isAJAX()) {
            //$valor = $this->request->getPost('idProducto');
            $this->usuarios->update($this->request->getPost('idUsuario'), ['estado' => 0]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }

    public function obtenerDatosEliminados()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('usuarios.id');
        $builder->select('usuarios.nombres');
        $builder->select('usuarios.primerApellido');
        $builder->select('usuarios.segundoApellido');
        $builder->select('usuarios.nombreUsuario');
        $builder->select('usuarios.password');
        $builder->select('usuarios.rol');
        $builder->where('usuarios.estado', 0);

        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $usuarios = $builder->get();
        $data['usuarios'] = $usuarios->getResult();
        echo json_encode($data);
    }


    public function reingresarDatosEliminados()
    {
        //$valor = $this->request->getPost('idProducto');
        if ($this->request->isAJAX()) {
            //$valor = $this->request->getPost('idProducto');
            $this->usuarios->update($this->request->getPost('idUsuarioEliminado'), ['estado' => 1]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }


    public function buscar2()
    {
        $busUsu = $this->request->getPost('buscarUsuario');

        $model = new UsuariosModel(); // Reemplaza 'MiModelo' con el nombre de tu modelo
        $resultado = $model->like('nombreUsuario', $busUsu)->findAll(); // Cambia 'nombre' por el campo que deseas buscar

        // Devuelve los resultados como JSON
        return $this->response->setJSON($resultado);
    }

    //METODO VERIFICAR PASSWORD PARA ACTUALIZAR PASSWORD
    public function actualizaPas()
    {
        $session = session();
        $nombreUsuario = $session->nombreUsuario;

        $password = $this->request->getPost('password');
        $cadena = strval($password);
        $datosUsuario = $this->usuarios->where('nombreUsuario', $nombreUsuario)->first();

        if (password_verify($cadena, $datosUsuario['password'])) {
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error']);
        }
    }

    //DEBEMOS GUIARNOS CON ESTE MÉTODO PARA REALIZAR LA ACTUALIZACIÓN DE LA CONTRACEÑA
    public function actualizaPasUsu()
    {
        $password = $this->request->getPost('newPassword');
        $cadena = strval($password);

        $contrasenaEncriptada = password_hash($cadena, PASSWORD_BCRYPT);

        $cambio = 1;
        if ($cambio == 1) {
            $session = session();
            $idUsuario = $session->idUsuario;

            $this->usuarios->update($idUsuario, ['password' => $contrasenaEncriptada]);

            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {

            return $this->response->setJSON(['message' => 'Error']);
        }
    }










































    //MÉTODOS CRUDDS ANTIGUOS
    public function eliminados2($estado = 0)
    {
        $usuarios = $this->usuarios->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Usuarios-Eliminados', 'datos' => $usuarios];
        echo view('header');
        echo view('usuarios/eliminados', $data);
        echo view('footer');
    }


    public function nuevo()
    {
        $data = ['titulo' => 'Agregar-Usuarios-Administrador'];
        echo view('header');
        echo view('usuarios/nuevo', $data);
        echo view('footer');
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


    public function actualizar2()
    {
        if ($this->request->getPost() && $this->validate($this->reglas)) {
            $this->usuarios->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('nombre')

            ]);

            return redirect()->to(base_url() . '/usuarios');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }


    public function eliminar2($id)
    {
        $this->usuarios->update($id, ['estado' => 0]);

        return redirect()->to(base_url() . '/usuarios');
    }


    public function reingresar($id)
    {
        $this->usuarios->update($id, ['estado' => 1]);

        return redirect()->to(base_url() . '/usuarios');
    }

    public function login()
    {
        echo view('login');
    }

    //----------------------------------------------------------------------


    public function insertar2()
    {
        $password = $this->request->getPost('password');
        $cadena = strval($password);
        $contrasenaEncriptada = password_hash($cadena, PASSWORD_BCRYPT);

        if ($this->request->getPost() && $this->validate($this->reglas)) {

            $this->usuarios->save([
                'nombreUsuario' => $this->request->getPost('nombreUsuario'),
                'password' =>  $contrasenaEncriptada,
                'rol' => $this->request->getPost('rol'),
                'estado' => 1
            ]);


            return redirect()->to(base_url() . '/usuarios');
        } else {

            $data = ['titulo' => 'Agregar-Usuarios', 'validation' => $this->validator];
            echo view('header');
            echo view('usuarios/nuevo', $data);
            echo view('footer');
        }
    }




    //-----------------------------------------------------------------------------

    //ESTAS SECIONES DEBEMOS LLAMARLO DENTRO DEL MÉTODO VALIDAR, ADENTRO DEL MÉTODO DONDE SE 
    //REALIZA LA VALIDACIÓN DEL PASSWORD
    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url());
    }

    public function cambia_pasword()
    {
        //$session = session();->ya estaba cmentado

        $usuario = $this->usuarios->where('estado', 1)->first();
        //$usuario = $this->usuarios->where('usuario', $session->id_usuario)->first();
        $data = ['titulo' => 'Cambiar Cntraseña', 'usuario' => $usuario];

        echo view('header');
        echo view('usuarios/cambia_pasword', $data);
        echo view('footer');
    }


    public function actualiza_pasword2()
    {
        $contrasena = 'password';
        $contrasenaEncriptada = password_hash($contrasena, PASSWORD_BCRYPT);

        if ($this->request->getPost() && $this->validate($this->reglasCambia)) {
            $session = session();
            $idUsuario = $session->idUsuario;

            $this->usuarios->update($idUsuario, ['password' => $contrasenaEncriptada]);
            //$encrypter = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
            $usuario = $this->usuarios->where('estado', 1)->first();
            $data = ['titulo' => 'Cambiar Cntraseña', 'usuario' => $usuario, 'validation' => $this->validator];

            echo view('header');
            echo view('usuarios/cambia_pasword', $data);
            echo view('footer');

            return redirect()->to(base_url() . '/usuarios');
        } else {

            $usuario = $this->usuarios->where('estado', 1)->first();
            //$usuario = $this->usuarios->where('usuario', $session->id_usuario)->first();
            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'validation' => $this->validator];

            echo view('header');
            echo view('usuarios/cambia_pasword', $data);
            echo view('footer');
        }
    }
}
