<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Cita;
use Model\Profesional;
use Model\Disciplina;
use Model\Usuario;
use MVC\Router;

class UsuariosController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /login');
        }
        session_start();

        $router->render('usuarios/index',[
            'titulo' => 'Área de usuarios',
            'nombre' => $_SESSION['nombre'],

        ] );
        
    }

    public static function citasConfirmadas(Router $router) {
        if(!is_auth()){
            header('Location: /login');
        }
        session_start();

        //Página actual la coge por URL
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        //Validamos que la página actual sea un entero y que sea mayor que uno
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /usuarios/citasConfirmadas?page=1');
        }
                
        //El número de registros por página lo ponemos nosotros
        $registros_por_pagina = 6;
        
        $idUsuario = $_SESSION['id'];
        $registros_totales = Cita::total('usuarioId', $idUsuario);
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);

        $citas = Cita::paginarCondicion('usuarioId', $idUsuario, 'fecha', $registros_por_pagina, $paginacion->offset());

        foreach($citas as $cita){
            $cita->profesional = Profesional::find($cita->profesionalId);
        };

        $router->render('usuarios/citasConfirmadas',[
            'titulo' => 'Resumen de citas',
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'cita' => $cita,
            'paginacion' => $paginacion->paginacion()
        ] );
        
    }

    public static function eliminar() {
        if(!is_auth()){
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $citas = Cita::find($id);

            if(!isset($citas)){
                header('Location: /usuarios/index');
            }

            $resultado = $citas -> eliminar();
            if($resultado){
                header('Location: /usuarios/index');
            }
        }
    }

    public static function datos(Router $router) {
        if(!is_auth()){
            header('Location: /login');
        }
        session_start();

        $alertas = [];
        $id = $_SESSION['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //Validamos que el id es un número entero

        if(!$id){
            header('Location: /login');
        }

        $usuario = Usuario::find($id);

        if(!$usuario){
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar();

            if(empty($alertas)){
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /usuarios/index');
                }
            }
        }


        $router->render('usuarios/datos',[
            'titulo' => 'Datos personales',
            'nombre' => $_SESSION['nombre'],
            'alertar' => $alertas,
            'usuario' => $usuario
        ] );
     
    }
}

