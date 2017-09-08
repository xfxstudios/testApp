<?php
$storagelocation = exo_getglobalvariable('HEPubStorageLocation', '');
$archivo = $storagelocation.'config.json';
$conf = file_get_contents($archivo);
$conf = json_decode($conf, true);

$user = $conf['user'];
$pass = $conf['pass'];
$host = $conf['host'];
$base = $conf['base'];

$db = new MySqli($host, $user, $pass, $base);
    if($db->connect_error) {
		die('Error de conexion ('.$db->connect_errno.')'
		.$db->connect_errno);
};
