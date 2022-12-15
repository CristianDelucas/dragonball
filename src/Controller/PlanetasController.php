<?php

namespace App\Controller;

use App\Entity\Planetas;
use App\Form\PlanetasFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanetasController extends AbstractController{

/**
* @Route("/planeta/{id}", name="getPlaneta")
*/

 //función para recoger un único planet pasado por la id
 public function getPlaneta(Planetas $planeta){

     return $this-> render("planetas/showPlaneta.html.twig", ["planeta"=>$planeta]);
 }


/**
* @Route ("/planetas", name="listPlanetas")
*/

//funcion para sacar la lista de planetas que tenemos en nuestra bbdd
 public function listPlanetas(EntityManagerInterface $doctrine)
 {
     $repo = $doctrine->getRepository(Planetas::class);
     $planetas = $repo->findAll();

     
     return $this->render("planetas/listPlanetas.html.twig", ["planetas"=>$planetas]);
 }


  /**
  * @Route ("/createPlaneta", name="createPlaneta")
  * @IsGranted("ROLE_ADMIN")
  */

  public function createPlaneta(Request $request, EntityManagerInterface $doctrine){
    $form= $this->createForm(PlanetasFormType::class);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $planeta = $form->getData();
        $doctrine->persist($planeta);
        $doctrine->flush();

        $this->addFlash('success',"El personaje {$planeta->getName()} fue insertado.");
        
        return $this->redirectToRoute('listPlanetas');
    }


    return $this->render("planetas/createPlaneta.html.twig", ["planetaForm"=>$form->createView()]);
}

/**
     * @Route("/updatePlaneta/{id}", name="updatePlaneta")
     * @IsGranted("ROLE_ADMIN")
     */
    public function updatePlaneta(Planetas $planeta, Request $request, EntityManagerInterface $doctrine)
    {
        $form=$this->createForm(PlanetasFormType::class,$planeta);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $planeta = $form->getData();
            $doctrine->persist($planeta);
            $doctrine->flush();

            $this->addFlash('success',"El planeta {$planeta->getName()} fue actualizado.");
            
            return $this->redirectToRoute('listPlanetas');
        }
        return $this->render("planetas/createPlaneta.html.twig", ["planetaForm"=>$form->createView()]);
    }


/**
* @Route("/deletePlaneta/{id}", name="deletePlaneta")
* @IsGranted("ROLE_ADMIN")
*/
    //al borrar redireccionamos a la sección de los planetas
    public function deletePlaneta(Planetas $planeta, EntityManagerInterface $doctrine)
    {
        $doctrine->remove($planeta);
        $doctrine->flush();

        return $this->redirectToRoute("listPlanetas");
    }



}