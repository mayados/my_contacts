<?php

namespace App\Controller;

use App\Repository\AnimalMemorialRepository;
use App\Repository\BelleHistoireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index()
    {
        return $this->render('home.html.twig');

    }

    #[Route('/notre/histoire', name: 'app_notre_histoire')]
    public function showNotreHistoire()
    {

        return $this->render('notreHistoire/notreHistoire.html.twig');
    }

    #[Route('/mentions/legales', name: 'app_mentions_legales')]
    public function showMentions()
    {

        return $this->render('annexes/mentions_legales.html.twig');
    }

    #[Route('/cgu', name: 'app_cgu')]
    public function showCGU()
    {

        return $this->render('annexes/cgu.html.twig');
    }

    #[Route('/politique/confidentialite', name: 'app_politique_confidentialite')]
    public function showPolitique()
    {

        return $this->render('annexes/politique_confidentialite.html.twig');
    }

}
