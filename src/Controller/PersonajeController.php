<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Form\PersonajeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PersonajeController extends AbstractController{

/**
 * @Route("/personaje/{id}", name="getPersonaje")
 */

 //función para recoger un único personaje pasado por la id
 public function getPersonaje(Personaje $personaje){

     return $this-> render("personajes/showPersonaje.html.twig", ["personaje"=>$personaje]);
 }


/**
* @Route ("/personajes", name="listPersonajes")
*/

//funcion para sacar la lista de personajes que tenemos en nuestra bbdd
 public function listPersonajes(EntityManagerInterface $doctrine)
 {
     $repo = $doctrine->getRepository(Personaje::class);
     $personajes = $repo->findAll();
     return $this->render("personajes/listPersonajes.html.twig", ["personajes"=>$personajes]);
 }

 /**
  * @Route ("/createPersonaje", name="createPersonaje")
  * @IsGranted("ROLE_ADMIN") 
  */

 public function createPersonaje(Request $request, EntityManagerInterface $doctrine, SluggerInterface $slugger){
     $form= $this->createForm(PersonajeFormType::class);
     $form->handleRequest($request);
     if($form->isSubmitted() && $form->isValid()){

        //$image = $form->get('photo')->getData();
        $personaje = $form->getData();

        //$path = $this->getParameter('kernel.proyect_dir').'/public/img';
        //mover imagen
        //$filename = $slugger->slug($personaje->getName()).'.'.$image->guessClientExtension();
       // $image->move($path,$filename);

        //$personaje->setImage("/img/$filename");

        $doctrine->persist($personaje);
        $doctrine->flush();

        $this->addFlash('success',"El personaje {$personaje->getName()} fue insertado.");
        
        return $this->redirectToRoute('listPersonajes');
    }

     return $this->render("personajes/createPersonaje.html.twig", ["personajeForm"=>$form->createView()]);
 }

/**
     * @Route("/updatePersonaje/{id}", name="updatePersonaje")
     * @IsGranted("ROLE_ADMIN")
     */
    public function updatePersonaje(Personaje $personaje, Request $request, EntityManagerInterface $doctrine)
    {
        $form=$this->createForm(PersonajeFormType::class,$personaje);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $personaje = $form->getData();
            $doctrine->persist($personaje);
            $doctrine->flush();

            $this->addFlash('success',"El personaje {$personaje->getName()} fue actualizado.");
            
            return $this->redirectToRoute('listPersonajes');
        }
        return $this->render("personajes/createPersonaje.html.twig", ["personajeForm"=>$form->createView()]);
    }



 /**
     * @Route("/deletePersonaje/{id}", name="deletePersonaje")
     * @IsGranted("ROLE_ADMIN") 
     */
    //al borrar redireccionamos a la sección de los personajes
    public function deletePersonaje(Personaje $personaje, EntityManagerInterface $doctrine)
    {
        $doctrine->remove($personaje);
        $doctrine->flush();

        return $this->redirectToRoute("listPersonajes");
    }



}