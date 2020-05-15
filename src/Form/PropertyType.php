<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,[
                'label'=>'Nom'
            ])
            ->add('description')
            ->add('surface')
            ->add('room',null,[
                'label'=>'Nbre de Pièces'
            ])
            ->add('bedroom',null,[
                'label'=>'Nbre de chambre'
            ])
            ->add('floor',null,[
                'label'=>'Etage'
            ])
            ->add('price',null,[
                'label'=>'Prix'
            ])
            ->add('heat',ChoiceType::class,[
                'choices'=> $this->getChoices(),
                'label'=>'Chauffage'
            ])
            ->add('city',null,[
                'label'=>'Ville'
            ])
            ->add('address',null,[
                'label'=>'Adresse'
            ])
            ->add('postal_code',null,[
                'label'=>'Code postal'
            ])
            ->add('sold',null,[
                'label'=>'Vendu'
            ])
            /*NOTE formconstruct 
            on met ce champ en commentaire pr pas kon puisse le modifier j'aurais pu le retier aussi
            ->add('created_at')
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

    private function getChoices(){
        $choices= Property::HEAT; /*NOTE ::
        la on utlise:: car c'est une constante?*/
        $output=[];
        foreach($choices as $k=> $v){
            $output[$v]=$k;/*NOTE
            ici on inverse clés et valeur pr avoir 
            une sortie gaz électrique etc etc de la constante plutot que 
            les numéros de la bdd*/
        }
        return $output;
    }

}
