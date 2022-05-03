<?php
namespace Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Controllers\BaseController;
use Models\ShirtsModel;

class CartController extends BaseController
{
    public function indexAction(Request $request)
    {
        $shirts = new ShirtsModel();
        $cart = $shirts->getUserCart(6);
        return new Response($this->getView('cart.html.twig', ['cart' => $cart]));
    }


    public function __invoke(Request $request)
    {
        return $this->{$request->get('_action').'Action'}($request);
    }
}