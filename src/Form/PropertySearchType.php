<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface',IntegerType::class,[
                'required'=>false,/*NOTES
                on laisse les champs à false car la recherche n'est pas obligatoire
                */
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Surface minimale'
                ]
            ])
            ->add('maxPrice',IntegerType::class,[
                'required'=>false,/*NOTES
                on laisse les champs à false car la recherche n'est pas obligatoire
                */
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Budget max'
                ]
            ])
           /* NOTES
            ->add('submit',SubmitType::class,[
                'label'=>'Rechercher'
            ])
            pour ne pas gacher l'Url on choisit de créer le bouton dans la view
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method'=>'get',/*ASK
                pourquoi choisir une méthode get
                en dehors de transmettre par l'url kel est la différence avec post
                */
            'csrf_protection'=>false/*NOTES
            il s'agit là d'une recherhce il n'y a pas à s'inquiéter du token
            c'est juste une récupération de data innocentes
            */
        ]);
    }
    public function getBlockPrefix()//ADD getBlockPrefix
    {
        /*NOTES
        cette méthode permet de changer ce qu'on lit dans l'url dans une methode get
        */
        return'';

    }
}
