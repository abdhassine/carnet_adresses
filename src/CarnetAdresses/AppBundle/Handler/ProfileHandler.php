<?php

namespace CarnetAdresses\AppBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Repository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CarnetAdresses\UserBundle\Entity\User;


class ProfileHandler {
    /** @var ObjectManager */
    private $om;
    
    /** @var string */
    private $entityClass;
    
    /** @var Repository */
    private $repository;
    
    
    public function __construct(ObjectManager $om, $entityClass) {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($entityClass);
    }
    
    
    public function get($username) {
        return $this->repository->getUserData($username);
    }
}
