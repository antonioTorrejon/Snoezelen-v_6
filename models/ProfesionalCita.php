<?php

namespace Model;


class ProfesionalCita extends ActiveRecord {
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'hora', 'paciente', 'email', 'telefono', 'motivo', 'profesionalId'];

    public $id;
    public $hora;
    public $paciente;
    public $email;
    public $telefono;
    public $motivo;
    public $profesionalId;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->paciente = $args['paciente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->motivo = $args['motivo'] ?? '';
        $this->profesionalId = $args['profesionalId'] ?? '';
    }
}