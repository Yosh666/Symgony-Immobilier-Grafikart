<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $em)
    {   
        $this->repository=$repository;
        $this->em= $em;
        
    }
    /**
     * @Route("/property", name="property.index")
     * @return Response
     * 
     */
    public function index():Response
    {
      
        /*$property= $this->repository->findAllVisible();
        $property[0]->setSold(true);
        $this->em->flush();*/
        return $this->render('property/index.html.twig', [
            'current_menu'=> 'properties' 
            
        ]);
    }
    /**
     * @Route ("/biens/{slug}-{id}", name="property.show",requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     * 
     */
    public function show(Property $property,string $slug):Response{

        if ($property->getSlug()!== $slug){
            return $this->redirectToRoute('property.show',[
                'id'=>$property->getId(),
                'slug' =>$property->getSlug()
            ],301);
        }


        return $this->render('property/show.html.twig', [
            'property'=>$property,
            'current_menu'=> 'properties' 
        ]);
    }




}
 /* ceci était un test qui marche wouhou!!! 
 mis dans public function index
       $property= new Property();
        $property->setTitle('mon premier test')
            ->setPrice(20000)
            ->setRoom(5)
            ->setBedroom(1)
            ->setDescription('blzblzlblz')
            ->setSurface(60)
            ->setFloor(3)
            ->setHeat(1)
            ->setCity('Montpellier')
            ->setAddress('3 rue vaugirard')
            ->setPostalCode('34000');
        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();*/