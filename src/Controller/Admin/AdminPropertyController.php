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

    public function __construct(PropertyRepository $repository,EntityManagerInterface $em)/*NOTE
     le repository va permettre d'utiliser les function qui nous permettent de voir les données findALL etc etc et donc de manipuler des objets property */
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
        $property= new Property();

        $form= $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $this->em->persist($property);/*NOTE persist
            la persistance fait passer la donnée stockée en mémoire (vive) à un état stocké durablement dans la BDD mais il est pas encore présent en base, 
            persist fait de ton entité un "candidat" à l'ajout !
            tu peux faire autant de persist que tu veux, si tu as 3 nouvelles entités à enregistrer
            il n'y aura à la fin qu'un seul et unique flush() (qui lui, inscrit les données PERSISTEES en base)
            dans le cas du update, pas de persist, elles ont été inscrites en base. */
            $this->em->flush();
            $this->addFlash('success','Nouveau venu dans la team \0/');
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
    public function edit(Property $property,Request $request):Response
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
            $this->em->flush();/*NOTE persist
            on pourrait faire un persist avant le flush mais ça ne changerait bien parce qu'il existe déja une équivalence dans la bdd*/
            $this->addFlash('success','Modifié tranquille pépouze tu vois');
            return $this->redirectToRoute("admin.property.index");
        }
        
        return $this->render('admin/adminproperty/edit.html.twig',[
            'property'=>$property,
            'form'=> $form->createView()/*NOTE form
            $form ne peut pas être envoyé directement il faut créer un objet ->createView()*/
        ]);
    }
   
    /**
     * @Route ("/admin/adminproperty/{id}", name="admin.property.delete",methods="DELETE")
     */
    public function delete(Property $property, Request $request):Response
    {
        if ($this->isCsrfTokenValid('delete'.$property->getId(), $request->get('_token')))  /*NOTE
        on vérifie la validité du token*/
        {   
             $this->em->remove($property);
            /*NOTE
            on retire l'objet property*/
           
            $this->em->flush();
            /*NOTE
            on porte l'information à la bdd */
            $this->addFlash('success','Il s\'est fait kicker 0_o');
            //return new Response ('Suppression');
        }
        
        return $this->redirectToRoute('admin.property.index');    
    }
        
           








}