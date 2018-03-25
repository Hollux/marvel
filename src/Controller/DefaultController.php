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
     * @Route("/previous", name="previous")
     * condition: "request.isXmlHttpRequest()"
     */
    public function previous()
    {
        $this->sessionParam->previous();
        $options = $this->sessionParam->getSessionParams();
        $tab = $this->call->characters($options);
        $pagination = $this->paginationTool->getPagination($tab['data']['total']);

        Return $this->render('Default/characters.html.twig', ["tab"=>$tab, "pagination"=>$pagination]);
    }

    /**
     * @Route("/next/{max}", name="next")
     * condition: "request.isXmlHttpRequest()"
     */
    public function next($max = null)
    {
        $this->sessionParam->next($max);
        $options = $this->sessionParam->getSessionParams();
        $tab = $this->call->characters($options);
        $pagination = $this->paginationTool->getPagination($tab['data']['total']);

        Return $this->render('Default/characters.html.twig', ["tab"=>$tab, "pagination"=>$pagination]);
    }

    /**
     * @Route("/page/{max}", name="page")
     * condition: "request.isXmlHttpRequest()"
     */
    public function page($max = null, Request $request)
    {

        $this->sessionParam->page($request->request->get('x'), $max);
        $options = $this->sessionParam->getSessionParams();
        $tab = $this->call->characters($options);
        $pagination = $this->paginationTool->getPagination($tab['data']['total']);

        Return $this->render('Default/characters.html.twig', ["tab"=>$tab, "pagination"=>$pagination]);
    }

}