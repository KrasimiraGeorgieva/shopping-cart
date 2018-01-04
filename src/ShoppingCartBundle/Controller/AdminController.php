<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\User;
use ShoppingCartBundle\Form\UserBanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_panel")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('ShoppingCartBundle:Product')->findAll();

        $categories = $em->getRepository('ShoppingCartBundle:Category')->findAll();

        $users = $em->getRepository('ShoppingCartBundle:User')->findAll();

        return $this->render('admin/panel.html.twig',
            [
                'products' => $products,
                'categories' => $categories,
                'users'=>$users
            ]
        );
    }

    /**
     * @Route("/admin/ban", name="ban_users")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and has_role('ROLE_ADMIN')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewBanUser()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ShoppingCartBundle:User')->findByBan();

        return $this->render('admin/ban.html.twig',
            [
                'users' => $users
            ]);
    }

    /**
     * @Route("/user/{id}/delete", name="admin_delete_user")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and has_role('ROLE_ADMIN')")
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUser(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ShoppingCartBundle:User')->find($id);

        if (!$user) {
            return $this->redirectToRoute('admin_panel');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash("delete", "User " . $user->getFullName() . " was successfully deleted.");

        return $this->redirect($this->generateUrl('admin_panel'));

    }

    /**
     * @Route("/user/{id}/ban", name="admin_edit_user")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editBanUsers(Request $request, int $id)
    {
        $banUser = $this->getDoctrine()->getRepository(User::class)->find($id);

        if ($banUser === null){
            return $this->redirectToRoute("admin_panel");
        }

        $banUserForm = $this->createForm(UserBanType::class, $banUser);
        $banUserForm->handleRequest($request);


        if ($banUserForm->isSubmitted() && $banUserForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($banUser);
            $em->flush();

            $this->addFlash("info", "Product " . $banUser->getFullName() . " was edited successfully");

            return $this->redirectToRoute('admin_panel', ['id' => $banUser->getId()]);
        }
        return $this->render('admin/admin_edit_user.html.twig',
            [
                'banUser' => $banUser,
                'editBanForm' => $banUserForm->createView()
            ]
        );
    }
}
