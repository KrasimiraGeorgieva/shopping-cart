<?php

namespace ShoppingCartBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class KernelListener
 * @package ShoppingCartBundle\EventListener
 */
class KernelListener
{
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() !== \Symfony\Component\HttpKernel\HttpKernel::MASTER_REQUEST) {
            return;
        }

        $bannedIps = ['127.16.0.1', '172.16.0.2', '172.16.0.3'];

        //$bannedIps[] = ['ip_address' => $ipAddress];

        if (in_array($event->getRequest()->getClientIp(), $bannedIps, true)) {
            $event->setResponse(new Response('Your IP is banned', 403));
        }
    }
}