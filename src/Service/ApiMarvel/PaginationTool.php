<?php

namespace App\Service\ApiMarvel;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PaginationTool
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }


    public function getPagination($max){

        //todo Passer 21 en param de char/page

        $pagination = [];

        //Recuperation base
        $offset = $this->session->get('offset');

        //nombre central
        if($offset){
            $paginationBase = $offset/21+1;
            $pagination['number'][4] = $paginationBase;
        } else {
            $paginationBase = 1;
            $pagination['number'][4] = 1;
        }

        //Pagination -
        $j = 1;
        for($i = 3; $i > 0; $i--){
            if($paginationBase-$j > 0){
                $pagination['number'][$i] = $paginationBase-$j;
            }else{
                $pagination['number'][$i] = null;
            }
            $j++;
        }

        //Pagination +
        $j = 1;
        for($i = 5; $i < 8; $i++){
            if($paginationBase+$j < $max/21){
                $pagination['number'][$i] = $paginationBase+$j;
            }else{
                $pagination['number'][$i] = null;
            }
            $j++;
        }

        //Previous
        $pagination['previous'] = !$offset || $offset <= 0 ? "hide" : "";

        //Next
        $pagination['next'] = $offset+21 >= $max ? "hide" : "";

        // rapide reorganisation
        ksort($pagination['number']);

        return $pagination;
    }

}