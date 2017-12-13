<?php

namespace ShoppingCartBundle\Controller;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_panel")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        // TODO
        return $this->redirectToRoute('category_index');
    }
}