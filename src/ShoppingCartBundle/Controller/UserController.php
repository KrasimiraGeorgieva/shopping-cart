<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\User;
use ShoppingCartBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

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

      if ($form->isSubmitted()&& $form->isValid()) {
          if ($user->getPassword() != $user->getConfirm()){
            $form->addError(new FormError("Password mismatch"));
            return $this->render('user/register.html.twig', ['form' => $form->createView()]);
          }
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
//
//            $roleRepository = $this->getDoctrine()->getRepository(Role::class);
//            $userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);
//
//            $user->addRole($userRole);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_profile');
        }
        return $this->render('user/register.html.twig',['form' => $form->createView()]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/profile", name="user_profile")
     */
    public function profileAction()
    {
        $user = $this->getUser();
        return $this->render("user/profile.html.twig", ['user' => $user]);
    }
}
