<?php
namespace Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Controllers\BaseController;
use Models\ShirtsModel;

class IndexController extends BaseController
{
    public function indexAction(Request $request): Response
    {
       $shirts = new ShirtsModel();
       $sort = $shirts->getShirtsRandom();
       return new Response($this->getView('index.html.twig', ['shirts' => $sort]));
    }


    public function __invoke(Request $request)
    {
        return $this->{$request->get('_action').'Action'}($request);
    }
}