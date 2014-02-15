<?php
namespace HtUserRegistrationDoctrineORM\Mapper;

use HtUserRegistration\Mapper\UserRegistrationMapperInterface;
use ZfcUser\Entity\UserInterface;
use Doctrine\ORM\EntityManager;
use HtUserRegistration\Options\DatabaseOptionsInterface;
use HtUserRegistration\Entity\UserRegistrationInterface;
use HtUserRegistrationDoctrineORM\Exception;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserRegistrationMapper implements UserRegistrationMapperInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Constructor
     *
     * @param EntityManager $em
     * @param DatabaseOptionsInterface $options
     *
     * @return void
     */
    public function __construct(EntityManager $em, DatabaseOptionsInterface $options)
    {
        $this->em       = $em;
        $this->options  = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function findByUser(UserInterface $user)
    {
        return $this->getRepository()->findBy(array('user' => $user));
    }

    protected function getRepository()
    {
        return $this->em->getRepository($this->options->getRegistrationEntityClass());
    }

    /**
     * {@inheritDoc}
     */
    protected function validateEntity($entity, $method)
    {
        if (!$entity instanceof UserRegistrationInterface) {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    '%s expects parameter 1 to be an instance of %s, %s provided instead',
                    $method,
                    'HtUserRegistration\Entity\UserRegistrationInterface',
                    is_object($object) ? get_class($object) : gettype($object)
                )
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $this->validateEntity($entity, __METHOD__);
        $this->persist($entity);
    }
    /**
     * {@inheritDoc}
     */
    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        $this->validateEntity($entity, __METHOD__);
        $this->persist($entity);
    }

    /**
     * Saves Entity 
     *
     * @param UserRegistrationInterface $entity
     *
     * @return UserRegistrationInterface
     */
    protected function persist(UserRegistrationInterface $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}
