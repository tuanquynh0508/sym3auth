<?php

namespace UserBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * JWTResponseListener.
 */
class JWTResponseListener
{
    /**
     * Add public data to the authentication response.
     *
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();

        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $userData = array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
        );
        $data['user'] = $userData;

        $event->setData($data);
    }
}
