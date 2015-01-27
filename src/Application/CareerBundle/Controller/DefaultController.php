<?php

namespace Application\CareerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Application\CareerBundle\Entity\Career;
use Application\CareerBundle\Form\CareerType;
use Application\CareerBundle\Form\CareerHandler;
use Application\CareerBundle\Manager\CareerManager;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationCareerBundle:Default:index.html.twig');
    }

    public function addAction() {
        $manager = new CareerManager($this);
        $career = new Career();
        $career->setUser($this->get('security.context')->getToken()->getUser());
    
        $form = $this->createForm(new CareerType(), $career);
        $formHandler = new CareerHandler($form, $this->get('request'), $manager);
            
        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('application_career_homepage'));
        }

        return $this->render('ApplicationCareerBundle:Default:add.html.twig', array(
            "form" => $form->createView(),
        ));
    }
}
