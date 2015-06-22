<?php

namespace HtUserRegistrationDoctrineORM\Entity;

use HtUserRegistration\Entity\UserRegistrationInterface;
use ZfcUser\Entity\UserInterface as ZfcUserInterface;
use Zend\Math\Rand;
use Datetime;

class UserRegistration implements UserRegistrationInterface
{
    protected $id;
    protected $token;
    protected $requestedAt;
    protected $hasResponded = false;
    protected $user;

    public function __construct(ZfcUserInterface $user = null)
    {
        $this->setUser($user);
        $this->requestedAt = new Datetime();
    }

    public function getId()
    {
        return $this->getId();
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($value)
    {
        $this->token = $value;

        return $this;
    }

    public function generateToken() {
        $this->setToken(
            Rand::getString(
                16,
                'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
                true
            )
        );
    }

    public function setUser(ZfcUserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getRequestedAt()
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(Datetime $value)
    {
        $this->requestedAt = $value;

        return $this;
    }

    public function setRequestTime(Datetime $value)
    {
        return $this->setRequestedAt($value);
    }

    public function getRequestTime()
    {
        return $this->getRequestedAt();
    }

    public function getHasResponded()
    {
        return $this->hasResponded;
    }

    public function setHasResponded($value)
    {
        $this->hasResponded = (bool) $value;

        return $this;
    }

    public function setResponded($value)
    {
        return $this->setHasResponded($value);
    }

    public function getResponded()
    {
        return $this->getHasResponded();
    }

    public function isResponded()
    {
        return $this->getHasResponded();
    }

}
