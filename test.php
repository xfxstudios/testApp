<?php
/*$fp = fopen("prueba.txt", "a+") or die("Couldn't open prueba.txt for writing!");

for($i=31; $i<=100; $i++){

    fwrite($fp, "Linea ".$i."\n") or die("Couldn't write values to file!"); 
}

fclose($fp);*/
/*header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-type: application/json');

$data = array("estado 1"=>"Activo","estado 2"=>"Inactivo","estado 3"=>"Suspendido","estado 4"=>"Retirado","estado 5"=>"No Especificado");

echo json_encode($data, true);*/
$global = '';

function prueba(){
    global $global;

    return $global*9;

}

for($i=1; $i<=10; $i++){
    $global = $i;
    echo $i.' x 9 = '.prueba()."<br>";
}