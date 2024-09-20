<?php

namespace Controllers;

use Classes\Paginacion;
use EmptyIterator;
use Model\Disciplina;
use MVC\Router;
use Model\Profesional;
use Intervention\Image\ImageManagerStatic as Image;

class ProfesionalesController {
    public static function index(Router $router) {   
       if(!is_admin()){
        header('Location: /login');
       }

        //Página actual la coge por URL
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        //Validamos que la página actual sea un entero y que sea mayor que uno
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /admin/profesionales?page=1');
        }
        
        //El número de registros por página lo ponemos nosotros
        $registros_por_pagina = 8;

        //Los registros totales los cogemos haciendo una consulta a la BBDD 
        $registros_totales = Profesional::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/profesionales?page=1');
        }

        $profesionales = Profesional::paginar('id', $registros_por_pagina, $paginacion->offset());

        foreach($profesionales as $profesional){
            $profesional->disciplina = Disciplina::find($profesional->disciplinas_id);
        }
        
        $router->render('admin/profesionales/index',[
            'titulo' => 'Profesionales',
            'profesionales' => $profesionales,
            'paginacion' => $paginacion->paginacion()
        ] );
    }

    public static function crear(Router $router) {
        if(!is_admin()){
            header('Location: /login');
        }
        
        $alertas=[];
        $profesional = new Profesional;
        $disciplinas = Disciplina::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }
            //Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/profesionales';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true); //el 0777 son los permisos y el true para permitir subdirectorios
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true)); //Generamos nombre aleatorio

                $_POST['imagen'] = $nombre_imagen;

            } 

            $_POST ['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES); //El unescaped para quitar los caracteres extraños, las diagonales invertidas

            $profesional->sincronizar($_POST);

            //Validamos
            $alertas = $profesional->validar();

            //Guardamos el registro
            if(empty($alertas)){
                //Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                //Guardar el registro en la BBDD
                $resultado = $profesional->guardar();

                if($resultado){
                    header('Location: /admin/profesionales');
                }
            }
        }

        $redes = json_decode($profesional->redes);
        
        $router->render('admin/profesionales/crear',[
            'titulo' => 'Registrar profesional',
            'alertas' => $alertas,
            'profesional' => $profesional,
            'disciplinas' => $disciplinas,
            'redes' => $redes
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
            header('Location: /admin/profesionales');
        }

        //Obtener el profesional a editar
        $profesional = Profesional::find($id);
        $disciplinas = Disciplina::all();

        if(!$profesional){
            header('Location: /admin/profesionales');
        }

        $profesional->imagen_actual = $profesional->imagen;

        $redes = json_decode($profesional->redes);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }

            //Revisamos si hay una nueva imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/profesionales';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true); //el 0777 son los permisos y el true para permitir subdirectorios
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true)); //Generamos nombre aleatorio

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $profesional->imagen_actual;
            }

            $_POST ['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $profesional->sincronizar($_POST);

            $alertas = $profesional->validar();

            if(empty($alertas)){
                if(isset($nombre_imagen)){
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }

                $resultado = $profesional->guardar();
                if($resultado){
                    header('Location: /admin/profesionales');
                }
            }
        }

        $router->render('admin/profesionales/editar',[
            'titulo' => 'Editar profesionales',
            'alertas' => $alertas,
            'profesional' => $profesional,
            'redes' => $redes,
            'disciplinas' => $disciplinas
        ] );
    }

    public static function eliminar() {
        if(!is_admin()){
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $profesional = Profesional::find($id);

        if(!isset($profesional)){
            header('Location: /admin/profesionales');
        }

        $resultado = $profesional -> eliminar();
        if($resultado){
            header('Location: /admin/profesionales');
        }
       }
    }

        
}