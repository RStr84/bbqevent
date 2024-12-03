<?php

namespace App\Controller;

use App\Model\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController

{
    #[Route('/')]
    public function letsgo(EventRepository $eventRepository): Response
    {

//        $party1 = ['name' => 'Techno', 'seats' => 100]; # Fuer die Technoparty sind noch 100 Plaetze frei!         von 200
//        $party2 = ['name' => 'Rock', 'seats' => 10]; # Achtung, fuer die Rockparty sind nur noch 10 Plaetze frei!  von 200
//        $party3 = ['name' => 'Hip Hop', 'seats' => 0]; # Hip Hop Event ist ausverkauft!!!                          von 200
//
//        $daten = ['name' => 'Hip Hop','partys' => ['party1', 'party2', 'party3']];
//        $daten2 = ['name' => 'Hip Hop','partys' => ['party1' => $party1, 'party2' => $party2, 'party3' => $party3]];
//        $daten3 = ['name' => 'Hip Hop','party1' => $party1];
        $daten4 = ['name' => 'Hip Hop', 'events' => $eventRepository->findAll()];

        return $this->render('main/letsgo.html.twig', $daten4);

    }

    /// 1.Version ///
//    #[Route('//show/{slug}}')]
//    public function show(string $slug = null): Response
//    {
//        if ($slug) {
//            $title = ucwords(str_replace('_', ' ', $slug));
//            return new Response("Zeige uns $title!");
//        } else {
//            return new Response('Zeige uns alle Partys!');
//        }
//    }


    /// 2.Version ///
    #[Route('/show/{id}')]
    public function show(string $id = null, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->findById($id);
        if($event) {
            return $this->render('main/show.html.twig', ['event' => $event]);
        } else {
            return new Response('Kein Event gefunden');
        }
    }


}

