<?php

namespace HtUserRegistrationDoctrineORM\Mapper;

use ZfcUser\Entity\UserInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use HtUserRegistration\Mapper\UserRegistrationMapperInterface;
use HtUserRegistration\Entity\UserRegistrationInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Stdlib\Hydrator\HydratorInterface;
use HtUserRegistrationDoctrineORM\Exception;

class UserRegistrationMapper implements
    UserRegistrationMapperInterface,
    ObjectManagerAwareInterface
{
    protected $objectManager;
    protected $entityClass;

    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Set the object manager
     *
     * @param ObjectManager|EntityManagerInterface $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager|EntityManagerInterface
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }

    public function findByUser(UserInterface $user)
    {
        return $user->getUserRegistration();
    }

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (! $entity instanceof UserRegistrationInterface) {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    '%s expects parameter 1 to be an instance of %s, %s provided instead',
                    $method,
                    'HtUserRegistration\Entity\UserRegistrationInterface',
                    (is_object($entity)) ? get_class($entity) : gettype($entity)
                )
            );
        }

        $this->getObjectManager()->persist($entity);
        $this->getObjectManager()->flush();
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        $this->getObjectManager()->persist($entity);
        $this->getObjectManager()->flush();
    }
}
