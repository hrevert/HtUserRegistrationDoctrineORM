HtUserRegistrationDoctrineORM
=============================

This module extends [HtUserRegistration](https://github.com/hrevert/HtUserRegistration)
by replacing the Zend DB code with Doctrine.

Install
-------

Require with composer
```
composer require apigility-skeletons/ht-user-registration-doctrine-orm
```

Include in config/application.config.php
```php
    'modules' => array(
        ...
        'HtUserRegistration',
        'HtUserRegistrationDoctrineORM',  // include after HtUserRegistration
        ...
    ),
```


Configure
----------

Your User entity must implement `HtUserRegistrationDoctrineORM\Entity\UserInterface`.

Copy `ht-user-registration-doctrine-orm/config/ht-user-registration-doctrine-orm.global.php.dist`
to your autoload directory and rename to `ht-user-registration-doctrine-orm.global.php`.

Edit `ht-user-registration-doctrine-orm.global.php` for your configuration.  Dynamic mapping
joins the `UserRegistration` entity to your User entity.  Most important is to edit the
`$userEntity` variable with your Doctrine user entity.

In `ht-user-registration.global.php` set
```php
    'registration_entity_class' => 'HtUserRegistrationDoctrineORM\Entity\UserRegistration',
```


Skipper
-------

A [Skipper](https://skipper18.com) module is included to add to your entity relationship diagram
as an attached skipper module.
