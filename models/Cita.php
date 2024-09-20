<?php

namespace Model;

class Cita extends ActiveRecord {
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId', 'profesionalId', 'motivo'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $profesionalId;
    public $motivo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->profesionalId = $args['profesionalId'] ?? '';
        $this->motivo = $args['motivo'] ?? '';
    }
}