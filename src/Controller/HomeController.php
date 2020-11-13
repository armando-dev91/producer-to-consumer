<?php

namespace App\Controller;

use App\Repository\FarmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(FarmRepository $farmRepository)
    {
        return $this->render('app/index.html.twig', [
            'farms' => $farmRepository->findAll() 
        ]);
    }
}