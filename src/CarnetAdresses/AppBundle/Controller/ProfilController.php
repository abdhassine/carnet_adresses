<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;


class ProfilController extends ContainerAware {

    /**
     * Renvoie la vue de la page de profil de l'utilisateur spécifié par son
     * username en paramètre.
     * 
     * @param string $username the username of the Profil to search
     * @return \CarnetAdresses\AppBundle\Controller\Response
     * @throws NotFoundHttpException if there is no user to return
     */
    public function viewAction($username) {
        $repository = $this->container->get('doctrine')
                ->getRepository('CarnetAdressesUserBundle:User');
        
        $user = $repository->findOneBy(array('username' => $username));
        if ($user === null) {
            throw new NotFoundHttpException("Le profil de $username n\'existe pas.");
        }
        
        $content = $this->container->get('templating')
                ->renderResponse('CarnetAdressesAppBundle:Front:profil.html.twig',
                        array(
                            'username' => $username,
                            'user'     => $user
                ));
        return $content;
    }

    
    public function clickOnAddAction() {
       return new RedirectResponse($this->container->get('router')->generate('carnet_app_ajouter'));
    }
    
    
    public function clickOnListingAction($username) {
        return new RedirectResponse($this->container->get('router')->generate('carnet_app_ajouter', array('username' => $username)));
    }

}
