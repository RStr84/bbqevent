<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController

{
    #[Route('/')]
    public function letsgo() :Response
    {
        $party1 = ['name' => 'Techno', 'seats' => 100]; # Fuer die Technoparty sind noch 100 Plaetze frei!
        $party2 = ['name' => 'Rock', 'seats' => 10]; # Achtung, fuer die Rockparty sind nur noch 10 Plaetze frei!
        $party3 = ['name' => 'Hip Hop', 'seats' => 0]; # Hip Hop Party ist ausverkauft!!!

        $daten = ['name' => 'Hip Hop','partys' => ['Party 1', 'Party 2', 'Party 3']];
        $daten2 = ['name' => 'Hip Hop','partys' => ['Party 1' => $party1, 'Party 2' => $party2, 'Party 3' => $party3]];

        return $this->render('main/letsgo.html.twig', $daten2);

    }

    #[Route('/show/{slug}')]
    public function show(string $slug = null) :Response
    {
        if ($slug) {
            $title = ucwords(str_replace('_', ' ', $slug));
            return new Response("Zeige uns $title!");
        } else{
            return new Response("Zeige uns alle Partys!");
        }
    }

}
