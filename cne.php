<?php 
error_reporting(E_ALL);
 ini_set('display_errors', '1'); 
/**
    * @email: info.fxstudios@gmail.com
    * @Fecha de ult. update: 11/09/2017
    * @Descripcion: Permite consultar el numero de cedula desde la pagina del CNE, solo debes tener acceso a internet y soporte para curl
 */

function getRealIP()
    {
        if( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) )
        {
            $client_ip =
            ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
            $_ENV['REMOTE_ADDR']
            :
            "unknown" );
            // los proxys van añadiendo al final de esta cabecera
            // las direcciones ip que van "ocultando". Para localizar la ip real
            // del usuario se comienza a mirar por el principio hasta encontrar
            // una dirección ip que no sea del rango privado. En caso de no
            // encontrarse ninguna se toma como valor el REMOTE_ADDR
            $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
            reset($entries);
            while (list(, $entry) = each($entries))
            {
                $entry = trim($entry);
                if ( preg_match("/^([0-9]+.[0-9]+.[0-9]+.[0-9]+)/", $entry, $ip_list) )
                {
                    // http://www.faqs.org/rfcs/rfc1918.html
                    $private_ip = array(
                    '/^0./',
                    '/^127.0.0.1/',
                    '/^192.168..*/',
                    '/^172.((1[6-9])|(2[0-9])|(3[0-1]))..*/',
                    '/^10..*/');
                    $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
                    if ($client_ip != $found_ip)
                    {
                        $client_ip = $found_ip;
                        break;
                    }
                }
            }
        }
        else
        {
            $client_ip =
            ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
            $_ENV['REMOTE_ADDR']
            :
            "unknown" );
        }
        return $client_ip;
    }//end

    function obtener($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        $curlData = curl_exec($curl);

        if($curlData === false)
                {
                    echo "Error Number:".curl_errno($curl)."<br>";
                    echo "Error String:".curl_error($curl);
                    curl_close($curl);
                }else{
                    curl_close($curl);
                    return $curlData;
                }
    }

    function cedula($cedula) {
        $res = obtener("https://cuado.co:444/api/v1?app_id=173&token=976b492e43ce2a3b0340a1811e59f001&cedula=".$cedula);
        $res= json_decode($res, true);
        return isset($res['data']) && $res['data'] ? $res['data'] : false;
    }

    print_r(cedula('AQUI NUMERO DE CEDULA'));
?>