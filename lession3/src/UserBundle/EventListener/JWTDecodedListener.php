<?php

namespace UserBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;

/**
 * JWTDecodedListener.
 */
class JWTDecodedListener
{
    /**
     * On JWT Decoded.
     *
     * @param JWTDecodedEvent $event
     */
    public function onJWTDecoded(JWTDecodedEvent $event)
    {
        $request = $event->getRequest();

        if (!$request) {
            return;
        }

        $payload = $event->getPayload();
        $request = $event->getRequest();

        $hasNoClientIp = !isset($payload['ip']) || $payload['ip'] !== $request->getClientIp();
        if ($hasNoClientIp) {
            $event->markAsInvalid();
        }
    }
}
