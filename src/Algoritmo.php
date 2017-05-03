<?php

namespace app\src;

class Algoritmo
{
    public $juego = array();
    public $nombre_algorit;
    public $tipo_agorit;
    public $resultado = array();
    public $actualX, $actualY, $finalX, $finalY = 0;

    public function __construct(array $arr, $tipo)
    {
        $this->juego = $arr;
        $this->resultado = $this->juego;
        $this->tipo_algorit = $tipo;

        if ($this->tipo_agorit == 2) {
            $this->nombre_algorit = 'Waypoint Navigation';
            $this->waypoint();
        } else {
            $this->nombre_algorit = 'Wall Tracing';
            $this->walltracing();
        }
    }

    public function waypoint()
    {
        $this->resultado = $this->juego;
    }

    public function walltracing()
    {
        $this->inicioFinal();
        $moverB = array();
        
        while ($this->actualX != $this->finalX && $this->actualY != $this->finalY) {
            // primero realiza bresenham
            
            $moverB = $this->bresenham();
            
            if ($this->resultado[$moverB[1]][$moverB[0]] != 1) {
                $this->actualY = $moverB[1];
                $this->actualX = $moverB[0];
                //Descomentar para pintar movimiento Bresenham                
                //$this->resultado[$this->actualY][$this->actualX] = 4;
            } else {
                
                if (($this->actualX - 1) >= 0 && $this->resultado[$this->actualY][$this->actualX - 1] != 1) {
                    //movimiento de la izquierda
                    $this->actualX = $this->actualX - 1;
                    //Descomentar para pintar movimiento a la izquierda
                    //$this->resultado[$this->actualY][$this->actualX] = 4;
                }
                elseif( ($moverW[1] - 1) >= 0 && $this->resultado[$this->actualY - 1][$this->actualX] != 1 ){
                    //movimiendo de arriba
                    $this->actualY = $this->actualY - 1;
                    //Descomentar para pintar movimiento a arriba
                    //$this->resultado[$this->actualY][$this->actualX] = 4;
                }
                elseif(($this->actualX + 1) <= count($this->resultado[$this->actualY]) && $this->resultado[$this->actualY][$this->actualX + 1] != 1){
                    //movimiento de la derecha
                    $this->actualX = $this->actualX + 1;
                    //Descomentar para pintar movimiento a la derecha
                    //$this->resultado[$this->actualY][$this->actualX] = 4;
                }
                elseif( ($this->actualY + 1) <= count($this->resultado) && $this->resultado[$this->actualY + 1][$this->actualX] != 1 ){
                    //movimiento de abajo
                    $this->actualY = $this->actualY + 1;
                    //Descomentar para pintar movimiento a abajo
                    //$this->resultado[$this->actualY][$this->actualX] = 4;
                }
            }
            //$this->resultado[$this->actualY][$this->actualX] = 4;
        }
        //$this->resultado[$this->actualY][$this->actualX] = 4;
    }

    public function inicioFinal()
    {

        foreach ($this->juego as $key => $fila) {
            foreach ($fila as $key2 => $columna) {
                //determinando inicio que equivale a un 2
                if ($columna == 2) {
                    $this->actualY = $key;
                    $this->actualX = $key2;
                }
                if ($columna == 3) {
                    $this->finalY = $key;
                    $this->finalX = $key2;
                }
            }
        }
    }

    public function bresenham()
    {
        $mover = array();
        $mover[0] = $this->actualX;
        $mover[1] = $this->actualY;
        

        $dx = $this->finalX - $mover[0];
        $dy = $this->finalY - $mover[1];
        
        //g.drawLine( $mover[0], $mover[1], $mover[0], $mover[1]);
        //$this->juego[$mover[1]][$mover[0]]= 4;
        if (abs($dx) > abs($dy)) {          // pendiente < 1
            $m = $dy / $dx;
            $b = $mover[1] - $m*$mover[0];
            if ($dx<0) {
                $dx =  -1;
            } else {
                $dx =  1;
            }
            if ($mover[0] != $this->finalX) {
                $mover[0] += $dx;
                $mover[1] = round($m*$mover[0] + $b);
                //g.drawLine( $mover[0], $mover[1], $mover[0], $mover[1]);
                //$this->juego[$mover[1]][$mover[0]]= 4;
            }
        } elseif ($dy != 0) {                              // slope >= 1
            $m = $dx / $dy;      // compute slope
            $b = $mover[0] - $m*$mover[1];
            if ($dy<0) {
                $dy =  -1;
            } else {
                $dy =  1;
            }
            if ($mover[1] != $this->finalY) {
                $mover[1] += $dy;
                $mover[0] = round($m*$mover[1] + $b);
                //g.drawLine( $this->actualX, $this->actualY, $this->actualX, $this->actualY);
                //$this->juego[$this->actualY][$this->actualX]= 4;
            }
        }
        // console.log(path);
        return $mover;
    }
}
