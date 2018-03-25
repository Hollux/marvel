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

        if($offset){
            $paginationBase = $offset/21+1;
            $pagination[4] = $paginationBase;
        } else {
            $paginationBase = 1;
            $pagination[4] = 1;
        }

        //Pagination -

        $j = 1;
        for($i = 3; $i > 0; $i--){
            if($paginationBase-$j > 0){
                $pagination[$i] = $paginationBase-$j;
            }else{
                $pagination[$i] = null;
            }
            $j++;
        }

        //Pagination +
        $j = 1;
        for($i = 5; $i < 8; $i++){
            if($paginationBase+$j < $max/21){
                $pagination[$i] = $paginationBase+$j;
            }else{
                $pagination[$i] = null;
            }
            $j++;
        }

        return $pagination;
    }

}