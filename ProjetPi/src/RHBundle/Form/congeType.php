<?php

namespace RHBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;






class congeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('datedeb' ,DateType::class, [
        'widget' => 'single_text',
        // this is actually the default format for single_text
        'format' => 'yyyy-MM-dd'])
            ->add('datefin',DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'])->
            add('type',ChoiceType::class,array(
        'choices'  => array(
            'Congé maternité' => "Congé maternité",
            'Congé de maladie' => "Congé de maladie",'Congé enfant malade' => "Congé enfant malade",'congé enseignement et de recherche' => "Congé enseignement et de recherche ",),))
            #->add('etat')
            ->add('contenu', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ]);


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RHBundle\Entity\conge'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rhbundle_conge';
    }


}
