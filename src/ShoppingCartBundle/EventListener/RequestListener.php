<?php
/**
 * Created by PhpStorm.
 * User: Krasimira
 * Date: 12/20/2017
 * Time: 17:02
 */

namespace ShoppingCartBundle\EventListener;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{

    public function onKernelRequest(GetResponseEvent $event)
    {
//        if($event->getRequest()->getClientIp() == "172.0.0.1") {
            $event->setResponse(new Response('STOP'));

//        }
    }
}