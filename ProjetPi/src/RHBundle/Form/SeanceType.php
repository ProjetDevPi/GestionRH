<?php

namespace RHBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('jour')->add('type',ChoiceType::class,array(
            'choices'  => array(
                'Seance Matinale' => "Seance Matinale",
                'Seance Midi ' => "Seance Aprés Midi", 'Seance Apres Midi' => "Seance Apres Midi",),))->add('salle')
            #->add('user')
            ->add('matiere' ,EntityType::class, ['class' => 'RHBundle\Entity\Matiere' , 'choice_label' => 'nommatiere' , 'multiple' => false , 'expanded' => false,]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RHBundle\Entity\Seance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rhbundle_seance';
    }


}
