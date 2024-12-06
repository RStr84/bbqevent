<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        return $this->render('location/show.html.twig', ["location" => $locationRepository->find($id)]);
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
//        $location = $locationRepository->findById($id);
//        return new Response('Hier kommt Delete hin!'), wenn kein twig erstellen
    }


    #[Route('/new', name: 'app_location_new')]
    public function new(EntityManagerInterface $entityManager) : Response
    {
        $location = new Location();
        $location->setName('The Street')
            ->setCapacity(10000)
            ->setAddress("Potsdamer Strasse 2, 10785 Berlin");

//        dd($location);
        $entityManager->persist($location);
        $entityManager->flush();
//        dd($location);
        return new Response('Ich bin drin!');
    }

}