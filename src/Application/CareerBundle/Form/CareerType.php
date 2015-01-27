<?php

namespace Application\CareerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CareerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime', array(
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy',
                'data' => new \DateTime("now")
            ))
            ->add('title', 'text', array(
                'required' => false,
            ))
            ->add('description', 'text', array(
                'required' => false))
            ->add('typeCareer', 'entity', array(
                    'class' => 'ApplicationCareerBundle:TypeCareer',
                    'property' => 'name',
                    'required' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\CareerBundle\Entity\Career'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_careerbundle_career';
    }

}
