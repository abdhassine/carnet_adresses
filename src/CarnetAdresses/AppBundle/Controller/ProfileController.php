<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

use CarnetAdresses\UserBundle\Entity\User;


/**
 * Controller de la page de profil des utilisateur autre que l'utlisateur connecté.
 */
class ProfileController extends ContainerAware {

    /**
     * Renvoie la vue de la page de profil de l'utilisateur spécifié.
     * 
     * @param User $user the user of the profile to show
     * @return \CarnetAdresses\AppBundle\Controller\Response
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
    
    
    /**
     * Action liée à l'ajout du membre dans le carnet d'adresses de l'utlisateur connecté.
     * 
     * @param Request $request the request sent by the user
     * @param User $user the user that will be added to the address book
     * @return RedirectResponse
     */
    public function addAction(Request $request, User $user) {
        $userSession = $this->container->get('security.context')->getToken()->getUser();
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
