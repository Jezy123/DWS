<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class BancoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('banco/index.html.twig', [
            'controller_name' => 'BancoController',
        ]);
    }


    #[Route('/nuevo', name: 'nuevo_miembro')]
    public function nuevo(ManagerRegistry $doctrine, Request $request) {

        $usuario = new Usuario();
    
        
    
        $formulario = $this->createForm(UsuarioFormType::class, $usuario);
    
        $formulario->handleRequest($request);
    
        if ($formulario->isSubmitted() && $formulario->isValid()) {
    
            $usuario = $formulario->getData();
    
            $entityManager = $doctrine->getManager();
    
            $entityManager->persist($usuario);
    
            $entityManager->flush();
    
           return $this->redirectToRoute('ficha_usuario', ["codigo" => $usuario->getId()]);
    
        }
    
        return $this->render('nuevo.html.twig', array(
    
            'formulario' => $formulario->createView()
    
        ));
    }

    #[Route('/usuario/todos', name: 'todos_usuario')]

    public function imprimir(ManagerRegistry $doctrine):Response{

        $repositorio = $doctrine->getRepository(Usuario:: class);

        $usuarios = $repositorio->findAll();

        return $this->render('lista_usuarios.html.twig',[
            'usuarios' => $usuarios
        ]);
    }


    #[Route('/usuario/{codigo}', name: 'ficha_usuario')]

    public function buscarUsuId(ManagerRegistry $doctrine , $codigo):Response{
        $repositorio = $doctrine->getRepository(Usuario::class);
        $usuario =$repositorio->find($codigo);

        return $this->render('ficha_usuario.html.twig',[
            'usuario' => $usuario
        ]);
      
    }

    #[Route('/usuario/buscar/{texto}', name: 'buscar_usuario')]

    public function buscarText(ManagerRegistry $doctrine, $texto):Response{

        $repositorio = $doctrine->getRepository(Usuario:: class);

        $usuarios = $repositorio->findByNombre($texto);

        return $this->render('lista_usuarios.html.twig',[
            'usuarios' => $usuarios
        ]);
    }

 

    #[Route('/usuario/update/{id}/{nombre}', name: 'modificar_usuario')]
    public function update(ManagerRegistry $doctrine, $id,$nombre): Response{
        $entityManager= $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Usuario::class);
        $usuario = $repositorio->find($id);
        if($usuario){
            $usuario-> setNombre($nombre);
            try{
                    $entityManager->flush();
                    return $this-> render('ficha_usuario.html.twig',[
                        'usuario' =>$usuario
                    ]);
            } catch(\Exception $e){
                return new Response("Error insertado objetos");
            }
        }else 
            return $this-> render('ficha_usuario.html.twig',[
                'usuario' => null
            ]);
    }


    #[Route('/usuario/editar/{codigo}', name: 'editar_usuario',requirements: ["codigo"=>"\d+"])]

    public function editar(ManagerRegistry $doctrine, Request $request, $codigo) {

        $repositorio = $doctrine->getRepository(Usuario::class);
    
        $usuario = $repositorio->find($codigo);
    
        if ($usuario){
    
            $formulario = $this->createForm(UsuarioFormType::class, $usuario);
    
            $formulario->handleRequest($request);
    
            if ($formulario->isSubmitted() && $formulario->isValid()) {
    
                $usuario = $formulario->getData();
    
                $entityManager = $doctrine->getManager();
    
                $entityManager->persist($usuario);
    
                $entityManager->flush();
    
                return $this->redirectToRoute('ficha_contacto', ["codigo" => $usuario->getId()]);
    
            }
    
            return $this->render('nuevo.html.twig', array(
    
                'formulario' => $formulario->createView()
    
            ));
    
        }else{
    
            return $this->render('ficha_contacto.html.twig', [
    
                'usuario' => NULL
    
            ]);
    
        }
    
    }
    


}
