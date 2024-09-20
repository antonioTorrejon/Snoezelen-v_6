<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Usuario;
use MVC\Router;

class RegistradosController {
    public static function index(Router $router) {
        if(!is_admin()){
            header('Location: /login');
           }
        //Página actual la coge por URL
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        //Validamos que la página actual sea un entero y que sea mayor que uno
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /admin/registrados?page=1');
        }
            
        //El número de registros por página lo ponemos nosotros
        $registros_por_pagina = 8;
    
        //Los registros totales los cogemos haciendo una consulta a la BBDD 
        $registros_totales = Usuario::total();
    
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);
    
        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/registrados?page=1');
        }
    
        $usuarios = Usuario::paginar('id', $registros_por_pagina, $paginacion->offset());

        $router->render('admin/registrados/index',[
            'titulo' => 'Usuarios registrados',
            'usuarios' => $usuarios
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

        if(!$id){
            header('Location: /admin/registrados');
        }

        $usuario = Usuario::find($id);

        if(!$usuario){
            header('Location: /admin/registrados');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar();

            if(empty($alertas)){
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /admin/registrados');
                }
            }
        }

        $router->render('admin/registrados/editar',[
            'titulo' => 'Editar profesionales',
            'alertas' => $alertas,
            'usuario' => $usuario
        ] );
    }

    public static function eliminar() {
        if(!is_admin()){
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $usuario = Usuario::find($id);

        if(!isset($usuario)){
            header('Location: /admin/registrados');
        }

        $resultado = $usuario -> eliminar();
        if($resultado){
            header('Location: /admin/disciplinas');
        }
       }
    }
}