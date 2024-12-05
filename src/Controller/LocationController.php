<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/location')]
class LocationController extends AbstractController
{

    #[Route('/', name: 'app_location_index')]
    public function index(LocationRepository $locationRepository): Response
    {
        return $this->render('location/index.html.twig', ['locations' => $locationRepository->findAll()]);
    }

    #[Route('/show/{id}', name: 'app_location_show')]
    public function show(int $id, LocationRepository $locationRepository): Response
    {
        return $this->render('location/show.html.twig', ["location" => $locationRepository->findById($id)]);
    }

    #[Route('/{id}/edit', name: 'app_location_edit')]
    public function edit(int $id, LocationRepository $locationRepository): Response
    {
        return $this->render('location/edit.html.twig');
    }

    #[Route('/{id}/delete', name: 'app_location_delete')]
    public function delete(int $id, LocationRepository $locationRepository): Response
    {
        return $this->render('location/delete.html.twig');
//        return new Response('Hier kommt Delete hin!'), wenn kein twig erstellen
    }



}