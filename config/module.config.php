<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'HtUserRegistration\UserRegistrationMapper' =>
                'HtUserRegistrationDoctrineORM\Factory\UserRegistrationMapperFactory',

            'HtUserRegistration\ModuleOptions' =>
                'HtUserRegistrationDoctrineORM\Factory\ModuleOptionsFactory',
        ),
    ),
);
