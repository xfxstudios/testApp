<?php
$storagelocation = exo_getglobalvariable('HEPubStorageLocation', '');
$archivo = $storagelocation.'config.json';


if(file_exists($archivo)){
    $file = file_get_contents($archivo);
    $file = json_decode($file, true);

    if($file['configured']===true){
        header('location: ghe://heserver/inicio.php?vaindex=si');
    }

}else{
    
    $file['configured'] = false;
    $file['user'] = "";
    $file['pass'] = "";
    $file['host'] = "";
    $file['base'] = "";

    $fp = fopen($archivo, "w") or die("Couldn't open $archivo for writing!");
    
    fwrite($fp, json_encode($file)) or die("Couldn't write values to file!"); 
    
    fclose($fp);
}

echo '
    <form method="post" action="configura.php">
        <p>
            <label>Host:</label>
            <input type="text" name="host" placeholder="Host"/>
        </p>

        <p>
            <label>Usuario:</label>
            <input type="text" name="usuario" placeholder="Usuario"/>
        </p>

        <p>
            <label>Clave:</label>
            <input type="text" name="clave" placeholder="Clave"/>
        </p>

        <p>
            <label>Base de Datos:</label>
            <input type="text" name="base" placeholder="Base de Datos"/>
        </p>

        <p>
            <input type="submit" value="Registrar"/>
        </p>

    </form>';

?>