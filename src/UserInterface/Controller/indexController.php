<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'index')]
final class indexController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('index.html.twig');
    }
}
