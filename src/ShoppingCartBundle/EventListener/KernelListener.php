<?php
/**
 * Created by PhpStorm.
 * User: Krasimira
 * Date: 12/18/2017
 * Time: 11:10
 */

namespace ShoppingCartBundle\EventListener;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class KernelListener
{
    // https://www.nomisoft.co.uk/articles/symfony-blocking-ips

    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() !== \Symfony\Component\HttpKernel\HttpKernel::MASTER_REQUEST) {
            return;
        }

        $bannedIps = array('127.16.0.1', '172.16.0.2', '172.16.0.3');

        if (in_array($event->getRequest()->getClientIp(), $bannedIps)) {
            $event->setResponse(new Response('Your IP is banned', 403));
        }

    }

}