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
        dump($this->call->characters());
        //dump($this->container->get('marvelPublicKey'));

        Return $this->render('Default/index.html.twig');
    }

}