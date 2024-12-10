<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationFormType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function edit(Location $location, EntityManagerInterface $entityManager): Response
    {
        $location->setName('The Street');
        $entityManager->persist($location);
        $entityManager->flush();

//        dd($location);
        return $this->redirectToRoute('app_location_show', ['id' => $location->getId()]);
    }

    #[Route('/{id}/delete', name: 'app_location_delete')]
    /// Umständliche Methode ///
//    public function delete(int $id, LocationRepository $locationRepository, EntityManagerInterface $entityManager): Response
    public function delete(Location $location, EntityManagerInterface $entityManager): Response
    {
//        $location = $locationRepository->find($id);

        $entityManager->remove($location);
        $entityManager->flush();
//        dd($location);
        return $this->redirectToRoute('app_location_index');
//        $location = $locationRepository->findById($id);
//        return new Response('Hier kommt Delete hin!'), wenn kein twig erstellen
    }


    #[Route('/new', name: 'app_location_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationFormType::class, $location, [
            'action' => $this->generateUrl('app_location_new'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $location = $form->getData();
            $entityManager->persist($location);
            $entityManager->flush();
//        $location->setName('The Street')
//            ->setCapacity(10000)
//            ->setAddress("Potsdamer Strasse 2, 10785 Berlin");

//        dd($location);
//        $entityManager->persist($location);
//        $entityManager->flush();
//        dd($location);
            return $this->redirectToRoute('app_location_show', ['id' => $location->getId()]);
        } else {
            return $this->render('location/new.html.twig', ['form' => $form->createView()]);
        }
    }
}