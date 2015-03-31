<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Routing\Router;


class ProfilController {
    private $em;
    private $templating;
    private $router;
    
    
    public function __construct(EntityManager $em, EngineInterface $templating, Router $router) {
        $this->em = $em;
        $this->templating = $templating;
        $this->router = $router;
    }
    
    
    /**
     * Renvoie la vue de la page de profil de l'utilisateur spécifié par son
     * username en paramètre.
     * 
     * @param string $username the username of the Profil to search
     * @return \CarnetAdresses\AppBundle\Controller\Response
     * @throws NotFoundHttpException if there is no user to return
     */
    public function viewAction($username) {
        $repository = $this->em->getRepository('CarnetAdressesUserBundle:User');
        
        $user = $repository->findOneBy(array('username' => $username));
        if (!$user) {
            throw new NotFoundHttpException("Le profil de $username n'existe pas.");
        }
        
        $content = $this->templating
                ->renderResponse('CarnetAdressesAppBundle:Front:profil.html.twig',
                        array(
                            'username' => $username,
                            'user'     => $user,
                ));
        return $content;
    }

    
    /**
     * 
     * @return RedirectResponse
     */
    public function clickOnAddAction($username) {
        return new RedirectResponse($this->router->generate('carnet_app_ajouter', 
                array('username' => $username)
        ));
    }
    
    
    /**
     * 
     * @param type $username
     * @return RedirectResponse
     */
    public function clickOnListingAction($username) {
        return new RedirectResponse($this->router->generate('carnet_app_listing', 
                array('username' => $username)
        ));
    }

}
