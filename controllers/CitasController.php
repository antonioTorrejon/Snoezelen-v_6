<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Cita;
use Model\Disciplina;
use Model\Profesional;
use MVC\Router;

class CitasController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /login');
        }

        $profesionales = Profesional::all();
        foreach($profesionales as $profesional){
            $profesional->disciplina = Disciplina::find($profesional->disciplinas_id);
        };

        session_start();

        $router->render('citas/index',[
            'titulo' => 'Crear nueva cita',
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido'],
            'email' => $_SESSION['email'],
            'id' => $_SESSION['id'],
            'profesionales' => $profesionales,
            'profesional' => $profesional
        ] );
    }

    public static function inicio(Router $router) {
        if(!is_admin()){
            header('Location: /login');
           }
                
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        //Validamos que la página actual sea un entero y que sea mayor que uno
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /admin/citas?page=1');
        }
        
        //El número de registros por página lo ponemos nosotros
        $registros_por_pagina = 6;

        //Los registros totales los cogemos haciendo una consulta a la BBDD 
        $registros_totales = Cita::total();

        //Creamos un nuevo objeto de la clase Paginacion con los atributos elegidos
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);

        //Paginamos todas las citas ordenadas por fecha
        $citas = Cita::paginar('fecha',$registros_por_pagina, $paginacion->offset());

        foreach($citas as $cita){
            $cita->profesional = Profesional::find($cita->profesionalId);
        };

        $router->render('admin/citas/inicio',[
            'titulo' => 'Citas',
            'citas' => $citas,
            'paginacion' => $paginacion->paginacion()
        ] );
        
    }

    public static function editar(Router $router) {
        if(!is_admin()){
            header('Location: /login');
        }

        $alertas = [];
        //Validar el ID que nos viene en la URL
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //Validamos que el id es un número entero

        //Si no tenemos id, redireccionamos
        if(!$id){
            header('Location: /admin/citas');
        }

        //Obtener el profesional a editar
        $cita = Cita::find($id);
        $profesional = Profesional::find($cita->profesionalId);

        //Si no tenemos cita, redireccionamos
        if(!$cita){
            header('Location: /admin/citas');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }

            $cita->sincronizar($_POST);

            $alertas = $cita->validar();

            if(empty($alertas)){
                $resultado = $cita->guardar();
                if($resultado){
                    header('Location: /admin/citas');
                }
            }
        }
        $router->render('admin/citas/editar',[
            'titulo' => 'Editar citas', 
            'cita' => $cita, 
            'profesional' => $profesional
        ] );
    }

    public static function eliminar() {
        if(!is_admin()){
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $cita = Cita::find($id);

        if(!isset($cita)){
            header('Location: /admin/citas');
        }

        $resultado = $cita -> eliminar();
        if($resultado){
            header('Location: /admin/citas');
        }
       }
    }

}