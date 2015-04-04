<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Form\Form;
use CarnetAdresses\UserBundle\Form\UserEditType;
use CarnetAdresses\UserBundle\Entity\User;


class AjouterController extends ContainerAware {

   public function ajouterAction($username) {
       return $this->container->get('templating')
               ->renderResponse('CarnetAdressesAppBundle:Front:ajouter.html.twig', array(
                   'username'   => $username,
               ));
   }
   
   
   public function searchContactAction() {
       
   }

}
