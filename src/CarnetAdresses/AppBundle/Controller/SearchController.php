<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;
use CarnetAdresses\AppBundle\Form\SearchFormType;


class SearchController extends ContainerAware {

    public function showAction() {
        $form = $this->container->get('form.factory')->create(new SearchFormType);

        return $this->container->get('templating')
                    ->renderResponse('CarnetAdressesAppBundle:Front:search.html.twig', array(
                        'form' => $form->createView(),
        ));
    }

    
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
