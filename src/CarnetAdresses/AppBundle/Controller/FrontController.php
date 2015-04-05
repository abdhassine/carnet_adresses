<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;


/**
 * Controller principal de l'application.
 */
class FrontController extends Controller {
    
    /**
     * Action sur la racine du site - redirection en fonction du type d'utilisateur :
     *      Un utilisateur annonyme sera redirigé vers la page de login
     *      Un utilisateur connecté sera redirigé vers son profil
     * @return RedirectResponse
     */
    public function indexAction() {
        $user = $this->getUser();
        
        if (!is_object($user) || !$user instanceof UserInterface) {
            return new RedirectResponse($this->generateUrl('fos_user_security_login'));
        }
        
        return $this->forward('CarnetAdressesAppBundle:Front:profile', array('username' => $user->getUsername()));
    }
    
    
    /**
     * Action liée au profil d'un utilisateur.
     * 
     * @param type $username the username of the user
     * @return Response
     * @throws NotFoundHttpException
     */
    public function profileAction($username) {
        $user = $this->get('fos_user.user_manager')->findUserBy(array('username' => $username));

        if (!$user) {
            throw new NotFoundHttpException("Aucun User ne correspond à $username.");
        }
        
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->isMethod('post')) {
            return $this->forward('CarnetAdressesAppBundle:Profile:add', array('request' => $request, 'user' => $user));
        }

        return $this->forward('CarnetAdressesAppBundle:Profile:show', array('user' => $user));
    }
    
    
    /**
     * Action liée à la recherche d'un membre du site
     * 
     * @return Response
     */
    public function searchAction() {
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->isMethod('post')) {
            return $this->forward('CarnetAdressesAppBundle:Search:search', array('request' => $request));
        }
        
        return $this->forward('CarnetAdressesAppBundle:Search:show');
    }
    
    
    /**
     * Action liée au contacts de l'utilisateur connecté.
     * 
     * @return Response
     */
    public function contactsAction() {
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->isMethod('post')) {
            return $this->forward('CarnetAdressesAppBundle:Contacts:delete', array('request' => $request));
        }
        
        return $this->forward('CarnetAdressesAppBundle:Contacts:show');
    }

}
