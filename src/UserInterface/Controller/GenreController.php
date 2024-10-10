<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\Gateway\GenreGateway;
use App\Domain\Gateway\MovieGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/genres', name: 'genres_list')]
final class GenreController extends AbstractController
{
    public function __invoke(GenreGateway $genreGateway, MovieGateway $movieGateway): Response
    {
        dd($movieGateway->findByPage());
        dd($movieGateway->findById(519182));
        dd($genreGateway->findAll());
    }
}
