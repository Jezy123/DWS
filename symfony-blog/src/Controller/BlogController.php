<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Post;
use App\Form\PostFormType;
class BlogController extends AbstractController
{
   
    #[Route('/single_post/{slug}', name: 'single_post')]
        public function post(ManagerRegistry $doctrine, $slug): Response
        {
            $repositorio = $doctrine->getRepository(Post::class);
            $post = $repositorio->findOneBy(["slug"=>$slug]);
             return $this->render('blog/single_post.html.twig', [
            'post' => $post,
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
        $post->setSlug($slugger->slug($post->getTitle()));
        $post->setPostUser($this->getUser());
        $post->setNumLikes(0);
        $post->setNumComments(0);
        $post->setNumViews(0);
        $entityManager = $doctrine->getManager();    
        $entityManager->persist($post);
        $entityManager->flush();
        return $this->redirectToRoute('single_post', ["slug" => $post->getSlug()]);
    }
    return $this->render('blog/new_post.html.twig', array(
        'form' => $form->createView()    
    ));
    }

    #[Route('/blog/{page}', name: 'blog', requirements: ['page' => '\d+'])]
    public function index(ManagerRegistry $doctrine, int $page = 1): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll($page);

        return $this->render('blog/blog.html.twig', [
            'posts' => $posts,
        ]);
    }

}