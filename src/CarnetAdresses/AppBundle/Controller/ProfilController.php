<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ProfilController extends Controller {
    
    /**
     * Renvoie la vue de la page de profil de l'utilisateur spécifié par son
     * username en paramètre.
     * 
     * @param string $username the username of the Profil to search
     * @return \CarnetAdresses\AppBundle\Controller\Response
     * @throws NotFoundHttpException if there is no user to return
     */
    public function viewAction($username) {
        $repository = $this->getDoctrine()->getManager()
                ->getRepository('CarnetAdressesUserBundle:User');
        
        $user = $repository->findOneBy(array('username' => $username));
        if ($user === null) {
            throw new NotFoundHttpException("Le profil de $username n\'existe pas.");
        }
        
        $content = $this->get('templating')
                ->render('CarnetAdressesAppBundle:Front:profil.html.twig',
                        array(
                            'username' => $username,
                            'userInfo' => $user
                ));
        return new Response($content);
    }

    
    public function clickOnAddAction() {
       return $this->redirect($this->generateUrl('carnet_app_ajouter'));
    }
    
    
    public function clickOnListingAction($username) {
        return $this->redirect($this->generateUrl('carnet_app_ajouter', array('username' => $username)));
    }

}
