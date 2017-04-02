<?php

namespace Ds\Bundle\UserBundle\Security\User;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

/**
 * Class User
 */
class User implements JWTUserInterface
{
    /**
     * @param string $username
     * @param array $payload
     * @return \Ds\Bundle\UserBundle\Security\User\User
     */
    public static function createFromPayload($username, array $payload)
    {
        return new User($username, $payload['roles'], $payload['uuid']);
    }

    /**
     * Constructor
     *
     * @param string $username
     * @param array $roles
     * @param string $uuid
     */
    public function __construct($username, array $roles, $uuid)
    {
        $this->username = $username;
        $this->roles = $roles;
        $this->uuid = $uuid;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
