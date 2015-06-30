<?php

namespace HtUserRegistrationDoctrineORM\Options;

interface DoctrineORMOptionsInterface
{
    public function getDoctrineObjectManager();
    public function setDoctrineObjectManager($value);
    public function getEnableDefaultEntities();
    public function setEnableDefaultEntities($value);
    public function getEnableDynamicMapping();
    public function setEnableDynamicMapping($value);
    public function getDynamicMappingConfig();
    public function setDynamicMappingConfig($value);
}
