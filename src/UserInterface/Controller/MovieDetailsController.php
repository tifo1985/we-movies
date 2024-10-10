<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\Request\MovieDetailsRequest;
use App\Domain\UseCase\MovieDetails;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/movies/{id}', name: 'movie_details')]
final class MovieDetailsController extends AbstractController
{
    public function __invoke(MovieDetails $movieDetails, int $id): Response
    {
        $response = $movieDetails->execute(new MovieDetailsRequest($id));

        return $this->render('partials/movie.html.twig', ['movie' => $response->getMovie()]);
    }
}
