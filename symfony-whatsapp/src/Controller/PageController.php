<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;


class PageController extends AbstractController
{
    #[Route('/', name: 'chat')]
    public function index(ManagerRegistry $doctrine, Request $request,AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user

        $lastUsername = $authenticationUtils->getLastUsername();
        $message=new Message();
        $form = $this->createForm(MessageFormType::class, $message);
        $repository = $doctrine->getRepository(User::class);
        $contactos = $repository->findAll();

        return $this->render('page/index.html.twig',array('form' => $form->createView(),'contactos' => $contactos,[

            'last_username' => $lastUsername,

            'error'         => $error,

        ]));
    }

    #[Route('/mensaje/enviar/{toUserId}', name: 'mensaje')]
    public function enviar(ManagerRegistry $doctrine, Request $request,AuthenticationUtils $authenticationUtils, int $toUserId): Response{

        $repository = $doctrine->getRepository(User::class);
        $toUser = $repository->find($toUserId);

        $mensaje = new Message();
        $form = $this->createForm(MessageFormType::class, $mensaje);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $mensaje->setFromUser($this->getUser());
            $mensaje->setToUser($toUser);
            $mensaje = $form->getData();
            $mensaje->setTimestamp( new DateTime());
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($mensaje);
            $entityManager->flush();
        }
        return $this->render('page/index.html.twig', array(
            'form' => $form->createView()    
        ));
    }

    #[Route('/mensaje/{toUserId}', name: 'cargarMensaje')]
    public function cargar(ManagerRegistry $doctrine, Request $request,AuthenticationUtils $authenticationUtils, int $toUserId):  JsonResponse{
        $repository = $doctrine->getRepository(Message::class);
        $data = [];
        $myid=$this->getUser()->getId();
        $mensajes=$repository->findByUsers($myid,$toUserId);
        foreach($mensajes as $mensaje){
            $item = [
                "id" => $mensaje->getId(),
                "from_user_id" => $mensaje->getFromUser()-> getId(),
                "from_user_name" => $mensaje->getFromUser()->getUserName(),
                "to_user_id" => $mensaje->getToUser()-> getId(),
                "text" => $mensaje-> getText(),
                "timestamp" => $mensaje -> getTimestamp(),

            ];
            $data[] = $item;
        }
         return new JsonResponse($data, Response::HTTP_OK);
        

    }
}
