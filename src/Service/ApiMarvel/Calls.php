<?php

namespace App\Service\ApiMarvel;


class Calls
{
    const Base_URI = 'https://gateway.marvel.com/v1/public/';
    const ValidParam = ["name", "nameStartsWith", "modifiedSince", "comics", "series", "events", "stories", "orderBy", "limit", "offset"];

    // utilise exploadOptions et basic param
    public function characters($options = null){

        //gestions param externes
        $extraParam = $options != null ? $this->explodeOptions($options) : "";
        //gestion param
        $param = $this->basicParam();
        // url
        $url = self::Base_URI."characters?".$extraParam.$param;

        // response
        $response = file_get_contents($url);
        // json decode
        $decodeResponse = json_decode($response, true);

        return $decodeResponse;

    }

    public function explodeOptions($options){
        //initialisation
        $extraparam = "";

        //boucle des options
        foreach($options as $key =>$option){
            //vérif option autorisé
            if( in_array($key, self::ValidParam)){

                //pas de & pour le premier .
                if($option == reset($options)){
                    $extraparam .= $key."=".$option;
                } else {
                    $extraparam .= "&".$key."=".$option;
                }
            }
        }

        return $extraparam;
    }

    public function basicParam(){
        // datetime pour $ts
        $date = new \DateTime();

        //param
        $ts = $date->getTimestamp();
        $hash = hash("md5", $ts.$_SERVER['MarvelPrivateKey'].$_SERVER['MarvelPublicKey']);
        //mise en ordre des param
        $param = "&ts=".$ts."&apikey=".$_SERVER['MarvelPublicKey']."&hash=".$hash;

        return $param;

    }

    public function getCharacterById($id){
        //gestion param
        $param = $this->basicParam();
        // url
        $url = self::Base_URI."characters/".$id."?limit=1".$param;

        // response
        $response = file_get_contents($url);
        // json decode
        $decodeResponse = json_decode($response, true);

        return $decodeResponse;
    }

}