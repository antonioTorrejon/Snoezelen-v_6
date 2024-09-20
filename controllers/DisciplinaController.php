<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Disciplina;

class DisciplinaController {
    public static function index(Router $router) {
        if(!is_admin()){
            header('Location: /login');
           }
                
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        //Validamos que la página actual sea un entero y que sea mayor que uno
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /admin/disciplinas?page=1');
        }
        
        //El número de registros por página lo ponemos nosotros
        $registros_por_pagina = 4;

        //Los registros totales los cogemos haciendo una consulta a la BBDD 
        $registros_totales = Disciplina::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/disciplinas?page=1');
        }

        $disciplinas = Disciplina::paginar('id',$registros_por_pagina, $paginacion->offset());

        $router->render('admin/disciplinas/index',[
            'titulo' => 'Disciplinas',
            'disciplinas' => $disciplinas,
            'paginacion' => $paginacion->paginacion()
        ] );
    }

    public static function crear(Router $router) {
        if(!is_admin()){
            header('Location: /login');
        }
        
        $alertas=[];
        $disciplina = new Disciplina;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $disciplina -> sincronizar($_POST);

            $alertas = $disciplina->validar();

            if(empty($alertas)){
                $resultado = $disciplina->guardar();

                if($resultado){
                    header('Location: /admin/disciplinas');
                }
            }
        }

        $router->render('admin/disciplinas/crear',[
            'titulo' => 'Registrar disciplina',
            'alertas' => $alertas,
            'disciplinas' => $disciplina 
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
            header('Location: /admin/disciplinas');
        }

        //Obtener el profesional a editar
        $disciplina = Disciplina::find($id);

        if(!$disciplina){
            header('Location: /admin/disciplinas');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }

            $disciplina->sincronizar($_POST);

            $alertas = $disciplina->validar();

            if(empty($alertas)){
                $resultado = $disciplina->guardar();
                if($resultado){
                    header('Location: /admin/disciplinas');
                }
            }
        }

        $router->render('admin/disciplinas/editar',[
            'titulo' => 'Editar disciplinas',
            'alertas' => $alertas,
            'disciplina' => $disciplina
        ] );
    }

    public static function eliminar() {
        if(!is_admin()){
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $disciplina = Disciplina::find($id);

        if(!isset($disciplina)){
            header('Location: /admin/disciplinas');
        }

        $resultado = $disciplina -> eliminar();
        if($resultado){
            header('Location: /admin/disciplinas');
        }
       }
    }

}