<?php

namespace Controllers;

use Model\Cita;
use Model\Disciplina;
use Model\Profesional;

class APIController {
    public static function index(){
        $profesional = Profesional::all();
        echo json_encode($profesional);
    }

    public static function disciplinas(){
        $disciplina = Disciplina::all();
        echo json_encode($disciplina);
    }

    public static function guardar(){
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        echo json_encode($resultado);
    }
}
