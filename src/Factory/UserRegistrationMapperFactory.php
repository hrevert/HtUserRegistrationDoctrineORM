<?php

namespace HtUserRegistrationDoctrineORM\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtUserRegistrationDoctrineORM\Mapper\UserRegistrationMapper;

class UserRegistrationMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtUserRegistration\ModuleOptions');
        $entityClass = $options->getRegistrationEntityClass();

        $mapper = new UserRegistrationMapper();
        $mapper->setObjectManager($serviceLocator->get($options->getDoctrineObjectManager()));
        $mapper->setEntityClass($entityClass);

        return $mapper;
    }
}
