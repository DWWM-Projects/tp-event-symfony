<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'event')]
    public function index(EventRepository $repository): Response
    {
        $events = $repository->findAll();

        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('Event/{id}', name: 'event_detail')]
    public function show(EventRepository $repository, $id)
    {
        $event = $repository->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Cet évènement n\'existe pas.');
        }

        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    
}
