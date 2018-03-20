<?php
namespace App\Controller;

use App\Service\ApiMarvel\Calls;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function __construct(Calls $call){
        $this->call = $call;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        Return $this->render('Default/index.html.twig');
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

}