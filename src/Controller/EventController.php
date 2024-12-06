<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/event')]
class EventController extends AbstractController
{

    #[Route('/', name: 'app_event_index')]
    public function index(EventRepository $eventRepository): Response
    {

        $data = $eventRepository->findAll();
//        dd($data);

        return $this->render('event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }

    #[Route('/show/{id}', name: 'app_event_show')]
    public function show(int $id, EventRepository $eventRepository): Response
    {
        return $this->render('event/show.html.twig', ["event" => $eventRepository->find($id)]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit')]
    public function edit(Event $event, EntityManagerInterface $entityManager): Response
    {
        $event->setName('Hip Hop');
        $event->setDescription('super Hip Hop Event');
        $event->setBookedSeats(200);
        $entityManager->persist($event);
        $entityManager->flush();

//        dd($location);
        return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
    }

    #[Route('/{id}/delete', name: 'app_event_delete')]
    public function delete(Event $event, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($event);
        $entityManager->flush();
        return $this->redirectToRoute('app_event_index');
    }

    #[Route('/new', name: 'app_event_new')]
    public function new(EntityManagerInterface $entityManager) : Response
    {
        $event = new Event();
        $event->setName('Techno')
            ->setDescription('super Techno Party')
            ->setBookedSeats(150);

//        dd($event);
        $entityManager->persist($event);
        $entityManager->flush();
//        dd($event);
        return new Response('Ich bin drin!');
    }


}