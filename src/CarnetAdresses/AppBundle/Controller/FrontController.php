<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;


class FrontController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        
        if (!is_object($user) || !$user instanceof UserInterface) {
            return new RedirectResponse($this->generateUrl('fos_user_security_login'));
        }
        
        return $this->forward('CarnetAdressesAppBundle:Front:profile', array('username' => $user->getUsername()));
    }
    
    
    public function profileAction($username) {
        $user = $this->get('fos_user.user_manager')->findUserBy(array('username' => $username));

        if (!$user) {
            throw new NotFoundHttpException("Aucun User ne correspond à $username.");
        }
        
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->getMethod() == 'POST') {
            return $this->forward('CarnetAdressesAppBundle:Profile:add', array('request' => $request, 'user' => $user));
        }

        return $this->forward('CarnetAdressesAppBundle:Profile:show', array('user' => $user));
    }
    
    
    public function searchAction() {
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->getMethod() == 'POST') {
            return $this->forward('CarnetAdressesAppBundle:Search:search', array('request' => $request));
        }
        
        return $this->forward('CarnetAdressesAppBundle:Search:show');
    }
    
    
    public function contactsAction() {
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->getMethod() == 'POST') {
            return $this->forward('CarnetAdressesAppBundle:Contacts:delete', array('request' => $request));
        }
        
        return $this->forward('CarnetAdressesAppBundle:Contacts:show');
    }

}
