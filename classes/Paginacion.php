<?php

namespace Classes;

class Paginacion{
    public $pagina_actual;
    public $registros_por_pagina;
    public $registros_totales;

    //Iniciamos con esos valores, que luego vamos a poder modificar
    public function __construct($pagina_actual = 1, $registros_por_pagina = 10, $registros_totales = 0)
    {
        $this->pagina_actual = (int) $pagina_actual; //Casteamos las variables para que sean enteros
        $this->registros_por_pagina = (int) $registros_por_pagina;
        $this->registros_totales = (int) $registros_totales;
    }

    //Calculamos el offset
    public function offset(){
        return $this->registros_por_pagina * ($this->pagina_actual - 1);
    }

    //Calculamos el total de páginas que vamos a tener
    public function total_paginas(){
        return ceil($this->registros_totales / $this->registros_por_pagina);
    }

    //Estos métodos detectan en que pagina están y en función de eso, si es posible ir a una siguiente o anteior
    public function pagina_anterior(){
        $anterior = $this->pagina_actual - 1;
        return ($anterior>0) ? $anterior : false;
    }

    public function pagina_siguiente(){
        $siguiente = $this->pagina_actual + 1;
        return ($siguiente <= $this->total_paginas()) ? $siguiente : false;
    }

    public function enlace_anterior(){
        $html = '';
        if($this->pagina_anterior()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_anterior()}\">&laquo; Anterior</a>";
        }
        return $html;
    }

    public function enlace_siguiente(){
        $html = '';
        if($this->pagina_siguiente()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_siguiente()}\">Siguiente &raquo;</a>";
        }
        return $html;
    }

    public function numeros_paginas(){
        $html= '';
        for($i=1; $i <= $this->total_paginas(); $i++ ) {
            if($i === $this->pagina_actual){
                $html .= "<span class=\"paginacion__enlace paginacion__enlace--actual\">{$i}</span>";
            } else {
                $html .= "<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page={$i}\">{$i}</a>";
            }
        }

        return $html;
    }

    public function paginacion(){
        $html = '';
        if($this->registros_totales > 1){
            $html .= '<div class="paginacion">';
            $html .= $this->enlace_anterior();
            $html .= $this->numeros_paginas();
            $html .= $this->enlace_siguiente();
            $html .= '</div>';
        }
        
        return $html;
    }
}
