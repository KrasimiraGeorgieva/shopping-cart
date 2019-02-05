<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\Role;
use ShoppingCartBundle\Entity\User;
use ShoppingCartBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package ShoppingCartBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getPassword() !== $user->getConfirm()) {
                $this->get('session')->getFlashBag()->set('error', 'Password mismatch!');

                $form = $this->createForm(UserType::class, $user);
                return $this->render('user/register.html.twig', ['form' => $form->createView()]);
            }

            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();

            $roleRepository = $this->getDoctrine()->getRepository(Role::class);

            $userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);
            if ($userRole === null) {
                $userRole = new Role();
                $userRole->setName('ROLE_USER');
                $em->persist($userRole);
            }

            $user->addRole($userRole);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('user/register.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/profile", name="user_profile")
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function profileAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($user->getPassword() !== $user->getConfirm()) {
                return $this->render('user/profile.html.twig', ['form' => $form->createView()]);
            }
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('info', $user->getFullName() . 'profile was successfully updated.');

            return $this->redirectToRoute('user_profile');
        }
        return $this->render('user/profile.html.twig',
            [
                'user' => $user,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/user/orders", name="user_orders")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listUserOrdersAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        $totalMoney = $user->getMoneySpent();
        $wallet = $user->getWallet();

        return $this->render('user/orders.html.twig',
            [
                'user' => $user,
                'orders' => $user->getOrderedProducts(),
                'total' => $totalMoney,
                'wallet' => $wallet,
            ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/user/products/created", name="user_products_created")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listCreatedProductsAction()
    {
        return $this->render('user/products.html.twig',
            [
                'products' => $this->getUser()->getProducts(),
                'user' => $this->getUser()->getFullName()
            ]);
    }
}