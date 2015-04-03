<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Form;

use CarnetAdresses\UserBundle\Entity\User;
use CarnetAdresses\UserBundle\Form\UserType;


class IndexController extends ContainerAware {
    
    /**
     * Revoie la vue de la page d'index.
     */
    public function viewAction() {
        // penser à la fonction isSubmitted pour les formulaires
        // isClicked pour les boutons
    }

    
    /**
     * Action liée à l'inscription d'un nouvel utilisateur sur l'application.
     */
    public function registerAction() {
        $user = new User();
        $subscribeForm = $this->container->get('form.factory')->create(new userType(), $user);
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if ($request->getMethod() == 'POST') {
            $subscribeForm->bind($request);

            if ($subscribeForm->isValid()) {
                $em = $this->container->get('doctrine')->getManager();
                $em->persist($user);
                $em->flush();

                return new RedirectResponse($this->container->get('router')
                                ->generate('carnet_app_profil', array(
                                    'username' => $user->getUsername(),
                )));
            }
        }
        
        return $this->container->get('templating')
                ->renderResponse('CarnetAdressesAppBundle:Front:index.html.twig', array(
                    'subscribeForm' => $subscribeForm->createView(),
                ));
    }
   
}
