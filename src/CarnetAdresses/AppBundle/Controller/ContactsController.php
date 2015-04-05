<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use CarnetAdresses\AppBundle\Form\AddressBookType;


/**
 * Controller de la page des contacts de l'utilisateur connecté.
 */
class ContactsController extends ContainerAware {

    /**
     * Renvoie la vue de la page des contacts de l'utilisateur connecté.
     * 
     * @return Response
     */
    public function showAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->container->get('doctrine')->getManager();
        $book = $em->getRepository('CarnetAdressesAppBundle:AddressBook')->findAddressBookOf($user);

        if ($book->isEmpty()) {
            $forms = null;
            $choices = null;
        } else {
            $contacts = $book->getContacts();

            foreach ($contacts as $contact) {
                $contactIds[] = $contact->getId();
            }

            $qb = $em->getRepository('CarnetAdressesUserBundle:User')
                        ->createQueryBuilder('u')->where('u.id IN (:ids)')
                        ->orderBy('u.surname, u.firstname', 'ASC')->setParameter('ids', $contactIds);
            $contactsForm = $this->container->get('form.factory')->create(new AddressBookType($qb), $book);
            $forms = $contactsForm->createView();

            $options = $contactsForm->get('contacts')->getConfig()->getOptions();
            $choices = $options['choice_list']->getChoices();
        }

        return $this->container->get('templating')
                        ->renderResponse('CarnetAdressesAppBundle:Front:contacts.html.twig', array(
                            'username' => $book->getOwner()->getUsername(),
                            'contactsForm' => $forms,
                            'choices' => $choices,
        ));
    }

    
    /**
     * Action liée à la suppression de contacts de l'utilisateur connecté.
     * 
     * @param Request $request the request sent by the user
     * @return RedirectResponse
     */
    public function deleteAction(Request $request) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->container->get('doctrine')->getManager();
        $book = $em->getRepository('CarnetAdressesAppBundle:AddressBook')->findAddressBookOf($user);

        $contacts = $book->getContacts();

        foreach ($contacts as $contact) {
            $contactIds[] = $contact->getId();
        }

        $qb = $em->getRepository('CarnetAdressesUserBundle:User')->createQueryBuilder('u')
                ->where('u.id IN (:ids)')->orderBy('u.surname, u.firstname', 'ASC')->setParameter('ids', $contactIds);
        $form = $this->container->get('form.factory')->create(new AddressBookType($qb), $book);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $session = $request->getSession();
            
            foreach ($data as $id) {
                $contact = $this->container->get('fos_user.user_manager')->findUserBy(array('id', $id));
                $session->getFlashBag()->add('confirm', $contact->getUsername().' a été supprimé de vos contacts.');
                $book->removeContact($contact);
            }
            $em->persist($book);
            $em->flush();
        }

        return new RedirectResponse($this->container->get('router')->generate('carnet_app_contacts'));
    }

}
