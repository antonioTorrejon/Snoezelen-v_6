<?php

namespace Controllers;

use Classes\Email;
use Model\Disciplina;
use Model\Profesional;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Usuario;

class PaginasController {
    public static function index(Router $router) {
        $disciplinas = Disciplina::all();

        //Obtener el total de cada bloque
        $profesionalesTotal = Profesional::total();
        $disciplinasTotal = Disciplina::total();
        $usuariosTotal = Usuario::total();
        //Buscamos no repetidos para poner el total en el resumen de la página inicial
        $ciudadesTotal = Profesional::totalNoRepetidos('ciudad'); 

        //Mostrar solamente 3 profesionales
        $profesionales_reducido = Profesional::get(3);
        foreach($profesionales_reducido as $profesional){
            $profesional->disciplina = Disciplina::find($profesional->disciplinas_id);
        };

        $router->render('paginas/index',[
            'titulo' => 'Inicio',
            'disciplinas' => $disciplinas,
            'profesionalesTotal' => $profesionalesTotal,
            'disciplinasTotal' => $disciplinasTotal,
            'usuariosTotal' => $usuariosTotal,
            'ciudadesTotal' => $ciudadesTotal,
            'profesionales_reducido' => $profesionales_reducido,
            'profesional' => $profesional
        ] );
    }

    public static function hacemos (Router $router) {

        $router->render('paginas/snoezelen',[
            'titulo' => 'Sobre Snoezelen App'
        ] );
    }

    public static function disciplinas (Router $router) {
        $disciplinas = Disciplina::all();

        $router->render('paginas/disciplinas',[
            'titulo' => 'Disciplinas disponibles',
            'disciplinas' => $disciplinas
        ] );
    }

    public static function profesionales (Router $router) {
        $profesionales = Profesional::all();
        foreach($profesionales as $profesional){
            $profesional->disciplina = Disciplina::find($profesional->disciplinas_id);
        };

        $router->render('paginas/profesionales/profesionales',[
            'titulo' => 'Profesionales disponibles',
            'profesionales' => $profesionales,
            'profesional' => $profesional,

        ] );
    }

    public static function loginprof(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $profesional = new Profesional($_POST);

            $alertas = $profesional->validarLogin();
            
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $profesional = Profesional::where('email', $profesional->email);
                if(!$profesional || !$profesional->confirmado ) {
                    Profesional::setAlerta('error', 'El Usuario No Existe o no esta confirmado');
                } else {
                    // El Usuario existe
                    if( password_verify($_POST['password'], $profesional->password) ) {
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $profesional->id;
                        $_SESSION['nombre'] = $profesional->nombre;
                        $_SESSION['apellido'] = $profesional->apellido;
                        $_SESSION['email'] = $profesional->email;
                        $_SESSION['profesional'] = $profesional->profesional;

                        if($profesional){
                            header('Location: /profesionales/index');
                        }
                      
                    } else {
                        Profesional::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }

        $alertas = Profesional::getAlertas();
        
        // Render a la vista 

        $router->render('paginas/profesionales/login-profesionales', [
            'titulo' => 'Iniciar sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logoutprof() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
    }

    public static function regprof (Router $router) {
        $alertas = [];
        $profesional = new Profesional();
        $disciplinas = Disciplina::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $profesional->sincronizar($_POST);
            
            $alertas = $profesional->validar_cuenta();

            if(empty($alertas)) {
                $existeUsuario = Profesional::where('email', $profesional->email);

                if($existeUsuario) {
                    Profesional::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Profesional::getAlertas();
                } else {
                    // Hashear el password
                    $profesional->hashPassword();

                    // Eliminar password2
                    unset($profesional->password2);

                    // Generar el Token
                    $profesional->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $profesional->guardar();

                    // Enviar email
                    $email = new Email($profesional->email, $profesional->nombre, $profesional->token);
                    $email->enviarConfirmacionProf();
                    

                    if($resultado) {
                        header('Location: /profesionales/mensaje-profesionales');
                    }
                }
            }
        }

        // Render a la vista
        $router->render('paginas/profesionales/registro-profesionales', [
            'titulo' => 'Crea tu cuenta en Snoezelen',
            'profesional' => $profesional, 
            'alertas' => $alertas,
            'disciplinas' => $disciplinas
        ]);
    }

    public static function mensajeprof(Router $router) {

        $router->render('paginas/profesionales/mensaje-profesionales', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmarprof (Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $profesional = Profesional::where('token', $token);

        if(empty($profesional)) {
            // No se encontró un usuario con ese token
            Profesional::setAlerta('error', 'Token No Válido');
        } else {
            // Confirmar la cuenta
            $profesional->confirmado = 1;
            $profesional->token = '';
            unset($profesional->password2);
            
            // Guardar en la BD
            $profesional->guardar();

            Profesional::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $router->render('paginas/profesionales/confirmar-profesionales', [
            'titulo' => 'Confirma tu cuenta en Snoezelen',
            'alertas' => Profesional::getAlertas(),
            'profesional' => $profesional
        ]);
    }

    public static function finalizar(Router $router) {
        $alertas = []; 
        //Validar el ID que nos viene en la URL
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //Validamos que el id es un número entero

        if(!$id){
            header('Location: /profesionales/profesionales');
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
                    header('Location: /profesionales/profesionales');
                }
            }
        }

        $router->render('paginas/profesionales/finRegistro', [
            'titulo' => 'Completa tu registro como profesional',
            'alertas' => $alertas,
            'profesional' => $profesional,
            'redes' => $redes,
            'disciplinas' => $disciplinas
        ]);
    }

    public static function olvideprof (Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profesional = new Profesional($_POST);
            $alertas = $profesional->validarEmail();

            if(empty($alertas)) {
                // Buscar el usuario
                $profesional = Profesional::where('email', $profesional->email);

                if($profesional && $profesional->confirmado) {

                    // Generar un nuevo token
                    $profesional->crearToken();
                    unset($profesional->password2);

                    // Actualizar el usuario
                    $profesional->guardar();

                    // Enviar el email
                    $email = new Email( $profesional->email, $profesional->nombre, $profesional->token );
                    $email->enviarInstruccionesProf();

                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';

                } else {
                
                    $alertas['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }
        }

        $router->render('paginas/profesionales/olvide-profesionales', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecerprof(Router $router) {
        $token = s($_GET['token']);

        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $profesional = Profesional::where('token', $token);

        if(empty($profesional)) {
            Profesional::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $profesional->sincronizar($_POST);

            // Validar el password
            $alertas = $profesional->validarPassword();

            if(empty($alertas)) {
                // Hashear el nuevo password
                $profesional->hashPassword();

                // Eliminar el Token
                $profesional->token = null;

                // Guardar el usuario en la BD
                $resultado = $profesional->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /profesionales/login-profesionales');
                }
            }
        }

        $alertas = Profesional::getAlertas();

        $router->render('paginas/profesionales/reestablecer-profesionales', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

    public static function registrarse (Router $router) {

        $router->render('paginas/registrarse',[
            'titulo' => 'Resgistrarse en Snoezelen',
        ] );
    }
}