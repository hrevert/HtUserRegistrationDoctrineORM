<?php
return array(
    'ht_user_registration' => [
        'registration_entity_class' => 'HtUserRegistrationDoctrineORM\Entity\UserRegistration',
    ],
    'doctrine' => array(
        'driver' => array(
            'HtUserRegistrationDoctrineORM\Entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/HtUserRegistrationDoctrineORM/'
            ),
            'HtUserRegistration\Entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/HtUserRegistration/'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'HtUserRegistrationDoctrineORM\Entity'  => 'HtUserRegistrationDoctrineORM\Entity',
                    'HtUserRegistration\Entity' => 'HtUserRegistration\Entity'
                )
            )
        ),
        'entity_resolver' => array(
            'orm_default' => array(
                'resolvers' => array(
                    'ZfcUser\Entity\UserInterface' => 'ZfcUser\Entity\User',
                )
            )
        ),
    ),
);
