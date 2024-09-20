<?php

//Funcion esencial durante el desarrollo: nos va ir ayudando a ver por pantalla lo que estamos haciendo
function comprobar ($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Utilizamos la función de PHP htmlspecialchars para atajar problemas con caracteres especiales
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Función que nos va devolver la página actual desde path
function pagina_actual($path) : bool{
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}

//Función para proteger las rutas para usuarios registrados
function is_auth() : bool{
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['usuario']) && !empty($_SESSION['usuario']);
}

//Función para proteger rutas de las áreas privadas de los profesionales registrados
function is_prof() : bool{
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['profesional']) && !empty($_SESSION['profesional']);
}

//Función para proteger las rutas del área privada del administrador
function is_admin() : bool{
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

//Función para animar aleatoriamente distintos elementos
function aos_animacion() : void {
    $efectos = ['fade-up', 'fade-down', 'fade-left', 'fade-right', 'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out'];
    $efecto = array_rand($efectos, 1);
    echo ($efectos[$efecto]);
}



