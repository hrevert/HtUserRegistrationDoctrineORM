<?php

namespace HtUserRegistrationDoctrineORM\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class DynamicMappingSubscriber implements EventSubscriber
{
    protected $config = array();

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        // the $metadata is the whole mapping info for this class
        $metadata = $eventArgs->getClassMetadata();

        switch ($metadata->getName()) {
            case $this->config['user_entity']['entity']:
                $metadata->mapOneToOne(array(
                    'targetEntity' => $this->config['user_registration_entity']['entity'],
                    'fieldName' => $this->config['user_registration_entity']['field'],
                    'mappedBy' => $this->config['user_entity']['field'],
                ));

                break;

            case $this->config['user_registration_entity']['entity']:
                // Add unique constriant for token
                // See https://github.com/TomHAnderson/zf-oauth2-doctrine/issues/24
                $tokenColumn = $metadata->columnNames['token'];
                $metadata->table['uniqueConstraints']['idx_' . $tokenColumn . '_unique']['columns'][] =
                    $tokenColumn;

                $joinMap = array(
                    'targetEntity' => $this->config['user_entity']['entity'],
                    'fieldName' => $this->config['user_entity']['field'],
                    'inversedBy' => $this->config['user_registration_entity']['field'],
                );
                if (isset($this->config['user_registration_entity']['additional_mapping_data'])) {
                    $joinMap = array_merge(
                        $joinMap,
                        $this->config['user_registration_entity']['additional_mapping_data']
                    );
                }
                $metadata->mapOneToOne($joinMap);
                break;

            default:
                break;
        }
    }
}
