<?php

namespace Application\CareerBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Application\CareerBundle\Entity\Career;
use Application\CareerBundle\Manager\CareerManager;

class CareerHandler
{
    private $form;
    private $request;
    private $manager;

    public function __construct(Form $form, Request $request, CareerManager $manager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->manager = $manager;
    }

    public function process()
    {
        if( $this->request->getMethod() == 'POST' )
        {
            $this->form->bind($this->request);

            if( $this->form->isValid() )
            {
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    public function onSuccess(Career $career) {
        $this->manager->persist($career);
        $this->manager->flush();
    }
}