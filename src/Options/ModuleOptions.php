<?php

namespace HtUserRegistrationDoctrineORM\Options;

use HtUserRegistration\Options\ModuleOptions as HtUserRegistrationModuleOptions;

class ModuleOptions extends HtUserRegistrationModuleOptions implements DoctrineORMOptionsInterface
{
    protected $doctrineObjectManager = 'doctrine.entitymanager.orm_default';
    protected $doctrineDriver = 'doctrine.driver.orm_default';
    protected $enableDefaultEntities = true;
    protected $enableDynamicMapping = true;
    protected $dynamicMappingConfig = array();

    public function getDoctrineObjectManager()
    {
        return $this->doctrineObjectManager;
    }

    public function setDoctrineObjectManager($objectManager)
    {
        $this->doctrineObjectManager = $objectManager;

        return $this;
    }

    public function getDoctrineDriver()
    {
        return $this->doctrineDriver;
    }

    public function setDoctrineDriver($value)
    {
        $this->doctrineDriver = $value;

        return $this;
    }

    public function getEnableDefaultEntities()
    {
        return $this->enableDefaultEntities;
    }

    public function setEnableDefaultEntities($value)
    {
        $this->enableDefaultEntities = $value;

        return $this;
    }

    public function getEnableDynamicMapping()
    {
        return $this->enableDynamicMapping;
    }

    public function setEnableDynamicMapping($value)
    {
        $this->enableDynamicMapping = (bool) $value;

        return $this;
    }

    public function getDynamicMappingConfig()
    {
        return $this->dynamicMappingConfig;
    }

    public function setDynamicMappingConfig($value)
    {
        $this->dynamicMappingConfig = $value;

        return $this;
    }
}
