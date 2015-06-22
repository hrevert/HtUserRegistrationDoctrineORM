<?php

namespace HtUserRegistrationDoctrineORM;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use HtUserRegistrationDoctrineORM\EventListener\DynamicMappingSubscriber;

class Module implements
    ConfigProviderInterface,
    AutoloaderProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap($e)
    {
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        $options = $sm->get('HtUserRegistration\ModuleOptions');


        if ($options->getEnableDefaultEntities()) {
            $chain = $sm->get($options->getDoctrineDriver());
            $chain->addDriver(
                new XmlDriver(__DIR__ . '/config/orm'),
                'HtUserRegistrationDoctrineORM\Entity'
            );
        }

        if ($options->getEnableDynamicMapping()) {
            $userClientSubscriber = new DynamicMappingSubscriber(
                $options->getDynamicMappingConfig()
            );

            $eventManager = $sm->get($options->getDoctrineObjectManager())->getEventManager();
            $eventManager->addEventSubscriber($userClientSubscriber);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/',
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
