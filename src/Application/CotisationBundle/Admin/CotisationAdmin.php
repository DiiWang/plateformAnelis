<?php

namespace Application\CotisationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CotisationAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('year', 'date', array('label' => 'Année'))
            ->add('typeCotisation', 'entity', array(
                'class' => 'ApplicationCotisationBundle:TypeCotisation',
                'property' => 'name',
                'label' => "Nom",
            ))
            ->add('user', 'entity', array(
                'class' => 'AdminUserBundle:User',
                'property' => 'name',
                'label' => "Nom",
            ))
            ->add('invoice.payed', 'sonata_type_boolean', array('transform' => true))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('user',null, array('label' => "Pseudo"))
            ->add('user.name',null,array('label' => "Nom"))
            ->add('user.surname',null,array('label' => "Prénom"))
            ->add('year','date',array('format' => 'y'))
            ->add('priceCotisation',null,array('label' => "Tarif Cotisation"))
            ->add('invoice.id', null, array('label' => "n° Facture"))
            ->add('invoice.payed',null,array('label' => "Payé ?"))
            // add custom action links
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
        ;
    }
}