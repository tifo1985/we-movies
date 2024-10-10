<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\Request\MovieListingRequest;
use App\Domain\UseCase\MovieListing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/movies', name: 'movies_list')]
final class MovieListingController extends AbstractController
{
    public function __invoke(MovieListing $movieListing, Request $request): Response
    {
        $criteria = $request->query->all();
        $page = (int) $criteria['page'] ?? 1;
        unset($criteria['page']);

        $response = $movieListing->execute(new MovieListingRequest($page, $criteria));

        return $this->render('partials/movies.html.twig', ['moviesPaginator' => $response->getMoviesPaginator()]);
    }
}
