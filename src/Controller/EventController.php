<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFormType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

//    #[Route('/new', name: 'app_event_new')]
//    public function new(EntityManagerInterface $entityManager, Request $request) : Response
//    {
////        dd($request->isMethod('POST'));
//        $event = new Event();
//        $event->setName('Techno')
//            ->setDescription('super Techno Party')
//            ->setBookedSeats(150);
//
////        dd($event);
//        $entityManager->persist($event);
//        $entityManager->flush();
////        dd($event);
//        return new Response('Ich bin drin!');
//    }


    #[Route('/new', name: 'app_event_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventFormType::class, $event, [
            'action' => $this->generateUrl('app_event_new'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event = $form->getData();
//            dd($event);

//        if ($request->isMethod('POST')) {
//            $event->setName($request->request->get('name'))
//                ->setDescription($request->request->get('description'))
//                ->setBookedSeats($request->request->get('seats'));
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);

        } else {
            return $this->render('event/new.html.twig', ['form' => $form->createView()]);
        }

    }


//    #[Route('/test', name: 'app_event_test')]
//    public function test(Request $request)
//    {
//        if ($request->isMethod('GET')) {
//            return $this->render('post.html.twig');
//        } elseif ($request->isMethod('POST')) {
//            $var = $request->request->all()['key'];
//            return new Response("Datenbanksachen $var");
//        }
//    }

//        #[Route('/test', name: 'app_event_test')]
//        public function test()
//        { return new Response('Ich komme von NEW');
//
//}

}