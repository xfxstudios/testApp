<?php
session_start();
$_SESSION['nombre'] = "Carlos Quintero";

header('Content-Type: text/html; charset=utf-8');
$storagelocation = exo_getglobalvariable('HEPubStorageLocation', '');

$archivo = $storagelocation.'config.json';

$file = file_get_contents($archivo);
$file = json_decode($file, true);

if($file['configured']){
    include('conec.php');

    var_dump($file['configured'])."<br>";
    var_dump($file['user'])."<br>";
    var_dump($file['pass'])."<br>";
    var_dump($file['host'])."<br>";
    var_dump($file['base'])."<br>";

    
    $a = $db->query("SELECT * FROM movimientos");
    $t = mysqli_num_rows($a);

    while($row = $a->fetch_array()){
        echo "<li>Transacción en fecha <b>".date("d-m-Y", strtotime($row['fecha']))."</b> por <b>".number_format($row['monto'],2)." Bs.</b></li>";
    }


    echo "<li>Hola ".$_SESSION['nombre']."</li>";
    echo "<li>Nombre del Equipo ".gethostname()."</li>";

    $storagelocation = exo_getglobalvariable('HEPubStorageLocation', '');
    
    echo $storagelocation;

}else{
    header('location:ghe://heserver/index.php?viene=si');
}

?>