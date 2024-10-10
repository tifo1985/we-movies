<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\UseCase\GenreListing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/genres', name: 'genres_list')]
final class GenreController extends AbstractController
{
    public function __invoke(GenreListing $genreListing): Response
    {
        $response = $genreListing->execute();

        return $this->render('partials/genres.html.twig', ['genres' => $response->getGenres()]);
    }
}
