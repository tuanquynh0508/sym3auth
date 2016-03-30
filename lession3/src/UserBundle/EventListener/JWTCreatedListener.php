<?php

namespace UserBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

/**
 * JWTCreatedListener.
 */
class JWTCreatedListener
{
    /**
     * Extended Token Time to Live.
     *
     * @var int
     */
    protected $extendedTokenTtl;

    /**
     * Set extended token time to livve.
     *
     * @param int $extendedTokenTtl
     */
    public function setExtendedTokenTtl($extendedTokenTtl)
    {
        $this->extendedTokenTtl = $extendedTokenTtl;
    }

    /**
     * On JWT Created.
     *
     * @param JWTCreatedEvent $event
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        if (!($request = $event->getRequest())) {
            return;
        }

        $payload = $event->getData();
        $user = $event->getUser();

        $payload['id'] = $user->getId();
        $payload['username'] = $user->getUsername();
        $payload['ip'] = $request->getClientIp();

        $rememberMe = $request->request->get('remember_me', 0);

        if ($rememberMe) {
            $payload['exp'] = time() + $this->extendedTokenTtl;
        }

        $event->setData($payload);
    }
}
