<?php

namespace Application\OffreBundle\Controller;

use Application\OffreBundle\Form\OffersType;
use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Admin\UserBundle\Entity\User;
use Application\OffreBundle\Manager\OffersManager;
use Application\OffreBundle\Manager\UserOffreManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class OffresController extends Controller
{	

    public function viewAction(Request $request)
    {
    	$offer = new Offers();
    	echo $this->getUser();
    	$em2 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\UserOffre');
        $query=$em2->find($this->getUser());
        if ($query==null)
        {
        	$userOffre = new UserOffre();
    		$userOffre->setNbpropmax(3);
    		$userOffre->setUserApp($this->getUser());
        }
        else
        {
        	$userOffre=$query;
        }

      	$em1 = $this->getDoctrine()->getManager();
       	$em1->persist($userOffre);
        $em1->flush();

    	$OffersForm = $this->get('form.factory')
            ->createNamed(
                '',
                OffersType::class,
                $offer,
                array(
                    'action' => $this->generateUrl('offre_homepage'),
                    'method' => 'POST'
                )
            );

        $OffersForm->handleRequest($request);
        $offer->setUser($userOffre);

        $results = null;
        $formSubmited = false;
        if ($OffersForm->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

        }

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

    	$onglet=1;
        return $this->render('OffreBundle:Default:index.html.twig',array(
            'onglet' => $onglet,
            'form' => $OffersForm->createView(),
            'formSubmited' => $formSubmited,
        ));
    }
   


}