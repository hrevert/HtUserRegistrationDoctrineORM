<?php
namespace HtUserRegistrationDoctrineORM\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtUserRegistrationDoctrineORM\Mapper\UserRegistrationMapper;

class UserRegistrationMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new UserRegistrationMapper(
            $serviceLocator->get('HtUserRegistrationDoctrineORM\Doctrine\Em'),
            $serviceLocator->get('HtUserRegistration\ModuleOptions')
        );
    }
}
