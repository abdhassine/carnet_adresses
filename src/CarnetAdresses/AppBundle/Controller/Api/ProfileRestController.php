<?php

namespace CarnetAdresses\AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class ProfileRestController extends FOSRestController {
    
    public function getProfileAction($username) {
        $profile = $this->container->get('carnet_adresses_app.profile_handler')->get($username);
        
        if (!$profile) {
            throw new NotFoundHttpException('No profile found');
        }
        
        return array('profile' => $profile);
    }
}
