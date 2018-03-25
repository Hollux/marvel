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
}