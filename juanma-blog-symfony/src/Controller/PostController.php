<?php

namespace App\Controller;

use App\Entity\Comentario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post; 
use App\Form\PostFormType;
use App\Form\SumbitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Form\ComentarioFormType;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }


    #[Route('/blog/new', name: 'new_post')]
    public function newPost(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {

        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();  
            $post->setPostUser($this->getUser());
            $post->setNumLikes(0);
            $post->setNumComments(0);

            if ($form->isSubmitted() && $form->isValid()) {
                $file = $form->get('image')->getData();
                if ($file) {
                    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            
                    // Move the file to the directory where images are stored
                    try {
                        
                        $file->move(
                            $this->getParameter('post_image_directory'), $newFilename
                        );
                       
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $post->setImage($newFilename);
                }
            }
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('single_post', ["title" => $post->getTitle()]);
        }
        return $this->render('blog/new_post.html.twig', array(
            'form' => $form->createView()    
        ));
    }

    #[Route('blog/single_post/{title}', name: 'single_post')]
    public function post(ManagerRegistry $doctrine,  Request $request,$title): Response
    {

        $comentario = new Comentario();
        $form = $this->createForm(ComentarioFormType::class, $comentario);
        $form->handleRequest($request);
        $repositorio = $doctrine->getRepository(Post::class);
        $post = $repositorio->findOneBy(["title"=>$title]);

        if ($form->isSubmitted() && $form->isValid()) {
            $comentario = $form->getData();    
            $comentario->setPost($post);
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($comentario);
            $entityManager->flush();
        }

        return $this->render('blog/single_post.html.twig', [
            'post' => $post,
            'commentForm' => $form->createView()
        ]);
    }




    #[Route('blog', name: 'blog')]
    public function blog(ManagerRegistry $doctrine,  Request $request): Response
    {

        $repositorio = $doctrine->getRepository(Post::class);
        $posts = $repositorio->findAll();


        return $this->render('blog/single_post.html.twig', [
            'posts' => $posts,

        ]);
    }

}
