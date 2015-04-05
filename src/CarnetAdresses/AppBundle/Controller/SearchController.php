<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;
use CarnetAdresses\AppBundle\Form\SearchFormType;


/**
 * Controller de la page de recherche de membre.
 */
class SearchController extends ContainerAware {
    
    /**
     * Renvoie la vue de la page de recherche de membre.
     * 
     * @return Response
     */
    public function showAction() {
        $form = $this->container->get('form.factory')->create(new SearchFormType);

        return $this->container->get('templating')
                    ->renderResponse('CarnetAdressesAppBundle:Front:search.html.twig', array(
                        'form' => $form->createView(),
        ));
    }

    
    /**
     * Action liée à la recherche de membres du site par les données entrées par
     * l'utilisateur.
     * 
     * @param Request $request the request sent by the user
     * @return Response
     */
    public function searchAction(Request $request) {
        $form = $this->container->get('form.factory')->create(new SearchFormType);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->container->get('doctrine')->getManager();
            $rawData = $form->getData();
            
            $data = array();
            foreach ($rawData as $key => $dataItem) {
                if ($dataItem) {
                    $data[$key] = $dataItem;
                }
            }

            if (!empty($data)) {
                $results = $em->getRepository('CarnetAdressesUserBundle:User')->findBy($data);
            } else {
                $results = null;
            }
            
            return $this->container->get('templating')
                    ->renderResponse('CarnetAdressesAppBundle:Front:result.html.twig', array(
                        'users' => $results,
                        'data'  => $data,
                    ));
        }
    }

}
