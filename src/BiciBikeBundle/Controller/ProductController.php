<?php

namespace BiciBikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        return $this->render('BiciBikeBundle:Product:index.html.twig');
    }
}
