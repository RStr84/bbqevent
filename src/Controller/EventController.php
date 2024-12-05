<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/event')]
class EventController extends AbstractController
{

    #[Route('/', name: 'app_event_index')]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }

    #[Route('/show/{id}', name: 'app_event_show')]
    public function show(int $id, EventRepository $eventRepository): Response
    {
        return $this->render('event/show.html.twig', ["event" => $eventRepository->findById($id)]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit')]
    public function edit(int $id, EventRepository $eventRepository): Response
    {
        return $this->render('event/edit.html.twig');
    }

    #[Route('/{id}/delete', name: 'app_event_delete')]
    public function delete(int $id, EventRepository $eventRepository): Response
    {
        return $this->render('event/delete.html.twig');
    }


}