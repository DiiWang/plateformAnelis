<?php

namespace Application\CotisationBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CotisationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = $options['choices'];
        $random_string = random_bytes(64);
        $builder
            ->add('typeCotisation', 'entity', array(
                'class' => 'ApplicationCotisationBundle:TypeCotisation',
                'choices' => $choices,
                'required' => true
            ))
            ->add($random_string, SubmitType::class, array('label' => 'Cotiser'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\CotisationBundle\Entity\Cotisation',
            'choices' => null,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'application_cotisationbundle_cotisation';
    }




}
