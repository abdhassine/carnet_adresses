<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Form\Form;
use CarnetAdresses\UserBundle\Form\UserEditType;
use CarnetAdresses\UserBundle\Entity\User;

class ProfilController extends ContainerAware {

    /**
     * Renvoie la vue de la page de profil de l'utilisateur spécifié par son
     * username en paramètre.
     * 
     * @param string $username the username of the Profil to search
     * @return \CarnetAdresses\AppBundle\Controller\Response
     * @throws NotFoundHttpException if there is no user to return
     */
    public function profilAction($username) {
        $em = $this->container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('CarnetAdressesUserBundle:User');

        $user = $userRepo->findOneBy(array('username' => $username));
        if (!$user) {
            throw new NotFoundHttpException("Aucun User ne correspond à $username.");
        }

        $editForm = $this->container->get('form.factory')->create(new UserEditType(), $user);
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if ($request->getMethod() == 'POST') {
            $editForm->handleRequest($request);
        }
        
        return $this->editProfilAction($editForm, $user);
    }

    
    /**
     * Action liée à l'édition du Profil de l'utilsateur spécifié par son username.
     * 
     * @param Form $editForm
     * @param User $user
     * @throws NotFoundHttpException
     */
    private function editProfilAction(Form $editForm, User $user) {
        if ($editForm->isValid()) {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($user);
            $em->flush();

            return new RedirectResponse($this->container->get('router')
                            ->generate('carnet_app_profil', array('username' => $user->getUsername())
            ));
        }
        
        return $this->container->get('templating')
                        ->renderResponse('CarnetAdressesAppBundle:Front:profil.html.twig', array(
                            'user' => $user,
                            'editForm' => $editForm->createView(),
        ));
    }

}
