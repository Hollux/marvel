<?php

namespace App\Service\ApiMarvel;


class Calls
{
    const  Base_URI = 'https://gateway.marvel.com/v1/public/';

    public function characters(){

        $date = new \DateTime();
        $ts = $date->getTimestamp();

        $hash = hash("md5", $ts.$_SERVER['MarvelPrivateKey'].$_SERVER['MarvelPublicKey']);

        dump(self::Base_URI."characters?ts=".$ts."&apikey=".$_SERVER['MarvelPublicKey']."&hash=".$hash);

        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,self::Base_URI."characters?ts=".$ts."&apikey=".$_SERVER['MarvelPublicKey']."&hash".$hash);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Test API marvel');
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);

       return $response;
    }


}