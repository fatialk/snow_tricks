<?php
namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\request;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('home.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }
}