<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function search()
    {
        $form1 = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé',
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'rounded p-2 bg-blue-300 hover:bg-blue-600 text-center text-white'
                ]
            ])
            ->getForm();

        return $this->render('base.html.twig', [
            'form1' => $form1->createView()
        ]);
    }

    #[Route('/handlesearch', name: 'handlesearch')]
    public function handleSearch(Request $request, EventRepository $repository)
    {
        $query = $request->request->get('form1')['query'];
        if ($query) {
            $events = $repository->FindEventsByName($query);
        }
        return $this->render('search/index.html.twig', [
            'events' => $events,
        ]);
    }
}
