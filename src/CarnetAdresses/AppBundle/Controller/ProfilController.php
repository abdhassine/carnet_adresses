<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;


class ProfilController extends ContainerAware {
    
    /**
     * Renvoie la vue de la page de profil de l'utilisateur spécifié par son
     * username en paramètre.
     * 
     * @param string $username the username of the Profil to search
     * @return \CarnetAdresses\AppBundle\Controller\Response
     * @throws NotFoundHttpException if there is no user to return
     */
    public function profilAction($username) {
        $em = $this->container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('CarnetAdressesUserBundle:User');
        
        $user = $userRepo->findOneBy(array('username' => $username));
        if (!$user) {
            throw new NotFoundResourceException("Aucun User ne correspond à $username.");
        }
        
        return $this->container->get('templating')
                ->renderResponse('CarnetAdressesAppBundle:Front:profil.html.twig', array('user' => $user));
    }
    
    
    /**
     * Action liée à l'édition du Profil de l'utilsateur spécifié par son username.
     * 
     * @param Request $request
     * @param string  $username
     * @throws NotFoundHttpException
     */
    public function editAction($username) {
        $em = $this->container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('CarnetAdressesUserBundle:User');
        $user = $userRepo->findBy(array('username' => $username));
    }

    
    /**
     * 
     * @return RedirectResponse
     */
    public function clickOnAddAction($username) {
        return new RedirectResponse($this->container->get('router')
                ->generate('carnet_app_ajouter', array('username' => $username)
        ));
    }
    
    
    /**
     * 
     * @param type $username
     * @return RedirectResponse
     */
    public function clickOnListingAction($username) {
        return new RedirectResponse($this->container->get('router')
                >generate('carnet_app_listing', array('username' => $username)
        ));
    }

}
