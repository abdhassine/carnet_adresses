<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use CarnetAdresses\UserBundle\Entity\User;
use CarnetAdresses\UserBundle\Form\UserType;


class IndexController extends Controller {
    
    /**
     * Revoie la vue de la page d'index.
     */
    public function viewAction() {
        $content = $this->get('templating')
                ->render('CarnetAdressesAppBundle:Front:index.html.twig');
        return new Response($content);
    }
    
    /**
     * Action liée à la connexion d'un utilisateur de l'application.
     */
    public function loginAction(Request $request) {
        
    }

    
    /**
     * Action liée à l'inscription d'un nouvel utilisateur sur l'application.
     */
    public function subscribeAction(Request $request) {
        $user = new User();
        $subscribeForm = $this->createForm(new UserType(), $user);
        
        if ($subscribeForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', 'Vous êtes bien inscrit.');
            
            return $this->redirect($this->generateUrl('carnet_app_profil', 
                    array(
                        'username' => $user->getUsername(),
            )));
        }
        
        $content = $this->get('templating')->render('CarnetAdressesAppBundle:Front:index.html.twig',
                array(
                    'subscribeForm' => $subscribeForm->createView(),
        ));
        
        return new Response($content);
    }

}
