<?php

//echo "Escogido el algoritmo:" . $_GET['algoritmo'];
namespace app\src;

ini_set('display_errors', 'On');
require_once('Algoritmo.php');


$filename = '../array2.txt';

$fp = @fopen($filename, 'r');
if ($fp) {
    $data = fread($fp, filesize($filename));
}
$data = explode("\n", $data);

$data2=array();
foreach ($data as $dat) {
    $data2[] = explode(",", $dat);
}

include '../pages/layout/header.php';
echo '<section id="resultado">';
echo '<table class="table table-bordered"> <tbody>';


if (isset($_GET['algoritmo'])) {
    $algoritmo = $_GET['algoritmo'];
    $juego = new Algoritmo($data2, $algoritmo);
    echo '<br><br><br><h1 class="text-center"> Resultado ' . $juego->nombre_algorit . '</h1><br><br><br>';

    $resultado = $juego->resultado;
    
    
    foreach ($resultado as $dat) {
        echo '<tr>';
        foreach ($dat as $dt) {
            //echo '<td class="celda'. $dt .'"></td>';
                
                echo '<td class="celda'. $dt .'"></td>';
        }
        echo '</tr>';
    }
} else {
    echo '<br><br><br><h1 class="text-center"> Debe seleccionar un algoritmo</h1><br><br><br>';
}
echo $juego->actualX;

echo '</tbody></table>';
echo '</section>';
/*
// Colocar si desea colocar el array
echo '<br><br><br><h1 class="text-center"> Array para el algoritmo: ' . $algoritmo_name . '</h1><br><br><br>';

echo '<pre id="array">';
print_r($data);
echo '</pre>';

echo '<pre>';
print_r($data2);
echo '</pre>';
*/
include '../pages/layout/footer.php';
