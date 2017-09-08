<?php

if( isset($_POST['host']) && isset($_POST['usuario'])  && isset($_POST['clave']) && isset($_POST['base'])){

    //Ruta de la Aplicación
    $storagelocation = exo_getglobalvariable('HEPubStorageLocation', '');
    $archivo = $storagelocation.'config.json';

    //Cargo Archivo de Configuracio Json
    $file = file_get_contents($archivo);
    $file = json_decode($file, true);


    //Preparo variables
    $file['host'] = $_POST['host'];
    $file['user'] = $_POST['usuario'];
    $file['pass'] = $_POST['clave'];
    $file['base'] = $_POST['base'];
    $file['configured'] = true;

    

        
    //Escribo el Arcivo    
    $fp = fopen($archivo, "w") or die("Couldn't open $archivo for writing!");
        
        fwrite($fp, json_encode($file)) or die("Couldn't write values to file!"); 
        
        fclose($fp);
    
        header('location: ghe://heserver/inicio.php?va=si');

}else{
    header('location: ghe://heserver/index.php?vieneconfig=si');
}