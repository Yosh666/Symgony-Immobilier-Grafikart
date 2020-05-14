<?php
namespace App\Controller\Admin;

//use App\Entity\Property;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController{


    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $em)//ASK le repository c'est pr récupérer des datas?
    {
        $this->repository=$repository;
        $this->em=$em;
    } 
    
    /**
     * @Route ("/admin", name="admin.property.index")
     * @return Response
     * 
     */
    public function index():Response
    {

        $properties= $this->repository->findAll();
        return $this->render ('admin/adminproperty/index.html.twig', compact('properties'));
    }
     /**
     * @Route("/admin/adminproperty/new", name= "admin.property_new")
     * 
     */
    public function new(Request $request):Response
    {
        $property= new Property();//BUG qui me saoule!!!!

        $form= $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $this->em->persist($property);//ASK persist?
            $this->em->flush();
            return $this->redirectToRoute("admin.property.index");
        }

        return $this->render('admin/adminproperty/new.html.twig',[
            'property'=>$property,
            'form'=> $form->createView()
        ]);
    }
    /**
     * @Route ("/admin/adminproperty/{id}", name="admin.property.edit",requirements={"id":"\d+"}, methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return Response//TODO response a voir de plus prés
     */
    public function edit(Property $property,Request $request)//ASK doit on toujours demander :Response?
    {
        $form= $this->createForm(PropertyType::class,$property);
        /*NOTE form 
        dans le form on entre toute les données du bien ciblé dans l'id*/
        $form->handleRequest($request);
        /*NOTE form
        ici on lui passe la requête donc c'est quand on clique sur le bouton*/

        if($form->isSubmitted() && $form->isValid())
        /*NOTE form
        ici on vérifie qu'on a bien cliqué sur le boouton
        et qu'on respecte les régles de validation*/
        {
            $this->em->flush();//ASK pas de persist?
            return $this->redirectToRoute("admin.property.index");
        }
        
        return $this->render('admin/adminproperty/edit.html.twig',[
            'property'=>$property,
            'form'=> $form->createView()/*NOTE form
            $form ne peut pas être envoyé directement il faut créer un objet ->createView()*/
        ]);
    }
   


}