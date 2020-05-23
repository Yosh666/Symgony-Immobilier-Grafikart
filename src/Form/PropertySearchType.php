<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\PropertySearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('options',EntityType::class,[
                'required'=>false,
                'label'=>false,
                'class'=> Option::class,
                'choice_label'=>'name',
                'multiple'=>true
            ]);
           /* NOTES
            ->add('submit',SubmitType::class,[
                'label'=>'Rechercher'
            ])
            pour ne pas gacher l'Url on choisit de créer le bouton dans la view
            */
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method'=>'get',
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
