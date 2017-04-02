<?php

namespace Ds\Bundle\UserBundle\Service;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager as BaseJWTManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTEncodedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class JWTManager
 */
class JWTManager extends BaseJWTManager
{
    /**
     * {@inheritdoc}
     */
    public function create(UserInterface $user)
    {
        $payload = ['roles' => $user->getRoles(), 'uuid' => $user->getUuid()];
        $this->addUserIdentityToPayload($user, $payload);

        $jwtCreatedEvent = new JWTCreatedEvent($payload, $user);
        $this->dispatcher->dispatch(Events::JWT_CREATED, $jwtCreatedEvent);

        $jwtString = $this->jwtEncoder->encode($jwtCreatedEvent->getData());

        $jwtEncodedEvent = new JWTEncodedEvent($jwtString);
        $this->dispatcher->dispatch(Events::JWT_ENCODED, $jwtEncodedEvent);

        return $jwtString;
    }
}
