<?php

namespace App\Service\ApiMarvel;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionParam
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getSessionParams(){

        //todo Passer 21 en param de char/page

        $param = [];

        // limit
        $limit = $this->session->get('limit');
        if($limit){
            $param['limit'] = $limit;
        } else {
            $param['limit'] = 21;
        }

        // offset
        $offset = $this->session->get('offset');
        if($offset){
            $param['offset'] = $offset;
        }

        // orderBy
        $orderBy = $this->session->get('orderBy');
        if($orderBy){
            $param['orderBy'] = $orderBy;
        }

        return $param;
    }

    public function previous(){
        //on cherche offset
       $offset = $this->session->get('offset');

        if($offset && $offset-21 >= 0){
           //on test si on peux réduire de 21
           $this->session->set('offset', $offset-21);
       } else {
            // sinon on reste page 1
           $this->session->set('offset', 0);
       }


       return true;
    }

    public function next($max){
        // on cherche offset
        $offset = $this->session->get('offset');

        if($offset && $offset+21 <= $max){
            //si offset + ne dépasse pas max
            $this->session->set('offset', $offset+21);
        } elseif($offset && $offset+21 >= $max) {
            // si offset mais dépasse max, on reste sur la même page
            $this->session->set('offset', $offset);
        } else {
            // si pas d'offset
            $this->session->set('offset', 21);
        }


        return true;
    }

    public function page($x, $max){
        if($x && ($x-1)*21 <= $max){
            // calcul si offset possible, et on le fait
            $this->session->set('offset', ($x-1)*21);
        }

        return true;
    }
}