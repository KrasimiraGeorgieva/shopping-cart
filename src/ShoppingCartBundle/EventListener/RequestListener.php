<?php

namespace ShoppingCartBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class RequestListener
 * @package ShoppingCartBundle\EventListener
 */
class RequestListener
{
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
//        if($event->getRequest()->getClientIp() == "172.0.0.1") {
            $event->setResponse(new Response('STOP'));
//        }
    }
}