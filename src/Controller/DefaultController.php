<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\request;

class DefaultController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {

        $tricks = [];

        return $this->render('home.html.twig', [
            'toto' => 'lolo'
        ]);
    }
}