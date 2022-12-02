<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contacto;
use App\Entity\Image;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactoFormType;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
{
    $repository = $doctrine->getRepository(Image::class);

    $images = $repository->findAll();

    return $this->render('page/index.html.twig', ['images' => $images]);
}


    #[Route('/about', name: 'about')]
    public function about(ManagerRegistry $doctrine, Request $request): Response
    {
    return $this->render('page/about.html.twig');
    }
    
    #[Route('/features', name: 'features')]
    public function features(ManagerRegistry $doctrine, Request $request): Response
    {
    return $this->render('page/features.html.twig');
    }

    #[Route('/blog', name: 'blog')]
    public function blog(ManagerRegistry $doctrine, Request $request): Response
    {
    return $this->render('page/blog.html.twig');
    }

    #[Route('/contact', name: 'contacto')]
    public function contact(ManagerRegistry $doctrine, Request $request): Response
    {
        $contact = new Contacto();
        $form = $this->createForm(ContactoFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contacto = $form->getData();    
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($contacto);
            $entityManager->flush();
            return $this->redirectToRoute('index', []);
        }
        return $this->render('page/contact.html.twig', array(
            'form' => $form->createView()    
        ));
    }
    
}
