<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddCommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreCommentaire',TextType::class,[
                'required' => true,
                'label'=> false,
            ])
            ->add('descriptionCommentaire',TextareaType::class,[
                'required' => false,
                'label'=> false,
            ])
            ->add('notationCommentaire',IntegerType::class,[
                'required' => true,
                'label'=> 'false',
                'attr' => ['min' => 0, 'max' => 5]
               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
