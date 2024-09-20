<?php

namespace Controllers;

use Model\ProfesionalCita;
use Classes\Paginacion;
use Model\Usuario;
use Model\Profesional;
use Model\Disciplina;
use Model\Cita;
use MVC\Router;

class CitasProfesionalController{
    public static function index(Router $router) {
        if(!is_prof()){
            header('Location: /login');
        }

        $router->render('paginas/profesionales/index',[
            'titulo' => 'Área personal de profesionales',
            'nombre' => $_SESSION['nombre'],
        ] );
    }

    public static function citas(Router $router) {
        if(!is_prof()){
            header('Location: /login');
        }

        //Buscador de citas por fecha
        $fecha = $_GET['fecha'] ?? date('Y-m-d'); //Comprueba si hay una fecha en el GET y si no coge la del servidor
        $fechas = explode('-', $fecha); //Nos separa el string de fecha por - para poder aplicar checkdate

        //Aplicamos chekdate: función de PHP que nos valida una fecha con los valores que le pasamos
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location: /404');
        }

        //Consultar la BB DD
        $consulta = "SELECT citas.id, citas.hora, CONCAT (usuarios.nombre, ' ', usuarios.apellido)as paciente, ";
        $consulta .= " usuarios.email, usuarios.telefono, citas.motivo, profesionales.id as profesionalId  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN profesionales ";
        $consulta .= " ON citas.profesionalId=profesionales.id  ";
        $consulta .= " WHERE fecha =  '{$fecha}' ";

        $citas = ProfesionalCita::SQL($consulta);

        $router->render('paginas/profesionales/citas',[
            'titulo' => 'Área personal de profesionales',
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas, 
            'fecha' => $fecha
        ] );
    }

    public static function citasTotal(Router $router) {
        if(!is_prof()){
            header('Location: /login');
        }
        session_start();

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
            
        //Validamos que la página actual sea un entero y que sea mayor que uno
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /profesionales/citas-total?page=1'); 
        }  
                    
        //El número de registros por página lo ponemos nosotros
        $registros_por_pagina = 6;
         
        $idProfesional = $_SESSION['id'];
        $registros_totales = Cita::total('profesionalId', $idProfesional);
            
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);
    
        $citas = Cita::paginarCondicion('profesionalId', $idProfesional, 'fecha', $registros_por_pagina, $paginacion->offset());

                    
        foreach($citas as $cita){
            $cita->usuario = Usuario::find($cita->usuarioId);
        };

        $router->render('paginas/profesionales/citas-total',[
            'titulo' => 'Resumen de citas',
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'cita' => $cita,
            'paginacion' => $paginacion->paginacion()
        ] );
        
    }

    public static function eliminar() {
        if(!is_prof()){
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $citas = Cita::find($id);

            if(!isset($citas)){
                header('Location: /profesionales/index');
            }

            $resultado = $citas -> eliminar();
            if($resultado){
                header('Location: /profesionales/index');
            }
        }
    }

    public static function datos(Router $router) {
        if(!is_prof()){
            header('Location: /login');
        }

        $alertas = [];
        //Validar el ID que nos viene en la URL
        $id = $_SESSION['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //Validamos que el id es un número entero

        if(!$id){
            header('Location: /login');
        }

        //Obtener el profesional a editar
        $profesional = Profesional::find($id);
        $disciplinas = Disciplina::all();

        if(!$profesional){
            header('Location: /profesionales/index');
        }

        $profesional->imagen_actual = $profesional->imagen;

        $redes = json_decode($profesional->redes);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_prof()){
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
                    header('Location: /profesionales/index');
                }
            }
        }

        $router->render('paginas/profesionales/datos',[
            'titulo' => 'Datos personales',
            'nombre' => $_SESSION['nombre'],
            'alertas' => $alertas,
            'profesional' => $profesional,
            'redes' => $redes,
            'disciplinas' => $disciplinas
        ] );
    }


}