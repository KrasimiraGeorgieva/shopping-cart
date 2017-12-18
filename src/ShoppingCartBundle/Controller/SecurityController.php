<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction()
    {
        $helper = $this->get('security.authentication_utils');

        if (null !== $helper->getLastAuthenticationError()) {
            return $this->render('security/ban.html.twig', array(
                'last_email' => $helper->getLastUsername(),
                'error' => $helper->getLastAuthenticationError(),
            ));
        }

        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout", name="security_logout")
     * @throws \Exception
     */
    public function logoutAction()
    {
        $this->addFlash('info', 'Come back again. :)');
        throw new \Exception('This should never be reached!');
    }
}
