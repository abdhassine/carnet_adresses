<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use CarnetAdresses\UserBundle\Entity\User;


class ProfileController extends ContainerAware {

    /**
     * Renvoie la vue de la page de profil de l'utilisateur spécifié par son
     * username en paramètre.
     * 
     * @param User $user the user of the profile to show
     * @return \CarnetAdresses\AppBundle\Controller\Response
     * @throws NotFoundHttpException if there is no user to return
     */
    public function showAction(User $user) {
        $userSession = $this->container->get('security.context')->getToken()->getUser();
        
        if ($user->getUsername() == $userSession->getUsername()) {
            $url = $this->container->get('router')->generate('fos_user_profile_show');
            return new RedirectResponse($url);
        }
        
        $em = $this->container->get('doctrine')->getManager();
        $book = $em->getRepository('CarnetAdressesAppBundle:AddressBook')->findAddressBookOf($userSession);
        $isContact = $book->contains($user);
        
        $view = 'CarnetAdressesAppBundle:Front:profile.html.twig';
        return $this->container->get('templating')->renderResponse($view, array(
            'user' => $user, 
            'isContact' => $isContact
        ));
    }
    
    
    public function addAction(Request $request, User $user) {
        $userSession = $this->container->get('security.context')->getToken()->getUser();
        
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Cet utilisateur n\'a pas accès à cette section.');
        }
        
        $em = $this->container->get('doctrine')->getManager();
        $book = $em->getRepository('CarnetAdressesAppBundle:AddressBook')->findAddressBookOf($userSession);
        $book->addContact($user);
        $em->persist($book);
        $em->flush();
        
        $session = $request->getSession();
        $session->getFlashBag()->add('confirm', $user->getUsername().' a bien été ajouté à vos contacts.');
        
        return new RedirectResponse($this->container->get('router')->generate('carnet_app_profile', array(
            'username' => $user->getUsername()
        )));
    }
}
