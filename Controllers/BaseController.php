<?php
namespace Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController{

    public $twig;

    public function getView(String $view, Array $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $this->twig = new \Twig\Environment($loader, []);
        return $this->twig->render($view, $params);
    }
}