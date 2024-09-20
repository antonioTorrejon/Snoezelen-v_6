<?php

namespace Model;

class Disciplina extends ActiveRecord {
    protected static $tabla = 'disciplinas';
    protected static $columnasDB = ['id', 'nombre', 'descripcion'];

    public $id;
    public $nombre;
    public $descripcion;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La descrcipcion es obligatoria';
        }
        return self::$alertas;
    }
}