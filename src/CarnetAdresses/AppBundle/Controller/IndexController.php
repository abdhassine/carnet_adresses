<?php

namespace CarnetAdresses\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Routing\Router;

use CarnetAdresses\UserBundle\Entity\User;
use CarnetAdresses\UserBundle\Form\UserType;


class IndexController {
    private $em;
    private $templating;
    private $formFactory;
    private $router;
    
    
    public function __construct(EntityManager $em, EngineInterface $templating, FormFactory $formFactory, Router $router) {
        $this->em = $em;
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }
    
    /**
     * Revoie la vue de la page d'index.
     */
    public function viewAction() {
        return $this->templating->
                renderResponse('CarnetAdressesAppBundle:Front:index.html.twig');
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
        $subscribeForm = $this->formFactory->create(new UserType(), $user);
        
        if ($subscribeForm->handleRequest($request)->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', 'Vous êtes bien inscrit.');
            
            return new RedirectResponse($this->render->generate('carnet_app_profil',
                    array(
                        'username'      => $user->getUsername(),
                        'user'          => $user,
            )));
        }
        
        $content = $this->templating->renderResponse('CarnetAdressesAppBundle:Front:index.html.twig',
                array(
                    'subscribeForm' => $subscribeForm->createView(),
        ));
        
        return $content;
    }

}
