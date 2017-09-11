<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Este modelo para Codeigniter, sirve para interactuar con  la RealDatabase de Google Firebase
Requiere de la instalación vía composer de la siguiente libreria
https://firebase-php.readthedocs.io/en/latest/setup.html
*/


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Firebase extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->fire = $this->service();
    }

    //Inicializo el Service
    public function service(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase/payven-c7a23c764d7d.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://payven-98cbb.firebaseio.com')
            ->create();
        
            return $firebase;
    }

    //Conecta con el nodo de la Base de Datos
    public function reference($X){
        $database = $this->fire->getDatabase();
        $reference = $database->getReference('/Datos/'.$X);
        return $reference;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente
    public function get($X){
        $snapshot = $this->reference($X)
        ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por la clave
    public function getByKey($X){
        $snapshot = $this->reference($X)
            ->orderByKey()
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por el Valor
    public function getByValue($X){   
        $snapshot = $this->reference($X)
            ->orderByValue()
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por un campo especifico
    public function getByChild($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por un campo especifico Con Limite de retorno al Inicio
    public function getToFirst($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->limitToLast($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


     //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por un campo especifico Con Limite de retorno al Final
     public function getToLast($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->limitToLast($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Estrae data de un nodo especificando un campo e indicando un filtro de mayor o igual que
    public function getStartAt($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->startAt($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Estrae data de un nodo especificando un campo e indicando un filtro de menor o igual que
    public function getEndAt($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->endAt($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Estrae data de un nodo especificando un campo e indicando un filtro igualdad exacta
    public function getEqualTo($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->equalTo($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Retorna un array con los nombres de las claves
    public function getKeys($X){
        $keys = $this->reference($X)  
            ->getChildKeys();

        return $keys;
    }

    //Inserta o Actualiza valores en un Nodo
    public function set($X){
        $set = $this->reference($X[0])
            ->set($X[1]);
        
        return "200";
    }


    //Inserta valores en un nodo y retorna la id de inserción
    public function put($X){
        $set = $this->reference($X[0])
            ->push($X[1]);

        return array('200',$set->getKey());
    }
   
}
