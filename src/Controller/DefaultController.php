<?php
namespace App\Controller;

use App\Service\ApiMarvel\Calls;
use App\Service\ApiMarvel\SessionParam;
use App\Service\ApiMarvel\PaginationTool;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    private $call;
    private $sessionParam;
    private $paginationTool;

    public function __construct(Calls $call, SessionParam $sessionParam, PaginationTool $paginationTool){
        $this->call = $call;
        $this->sessionParam = $sessionParam;
        $this->paginationTool = $paginationTool;
    }

//* requirements={"limit" ,"offset", "fav")

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $options = $this->sessionParam->getSessionParams();
        $tab = $this->call->characters($options);
        $pagination = $this->paginationTool->getPagination($tab['data']['total']);

        Return $this->render('Default/index.html.twig', ["tab"=>$tab, "pagination"=>$pagination]);
    }

    /**
     * @Route("/getCharacters/{limit}/{offset}", name="getCharacters")
     * condition: "request.isXmlHttpRequest()"
     */
    public function getCharacters($limit = 20, $offset = 0)
    {
        $options = ['limit' => $limit, 'offset' => $offset];
        $tab = $this->call->characters($options);

        Return $this->render('Default/getCharacters.html.twig', ["tab"=>$tab]);
    }

    public function getCharacter($name){


    }

}