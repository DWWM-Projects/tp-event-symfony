<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/event/create', name: 'event_create')]
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $event = new Event;

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($event);
            $manager->flush();

            $this->addFlash('success', 'L\'évènement à été créé');

            return $this->redirectToRoute('event');
        }

        return $this->render('event/create.html.twig', [
            'form' => $form->createView(),
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
