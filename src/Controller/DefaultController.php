<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('home.html.twig', [
            'tricks' => $trickRepository->findBy([], ['createdAt' => 'DESC'])
        ]);
    }
}
