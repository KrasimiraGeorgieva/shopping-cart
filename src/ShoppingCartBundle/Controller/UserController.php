<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\Role;
use ShoppingCartBundle\Entity\User;
use ShoppingCartBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
              $this->get('session')->getFlashBag()->set('error', "Password mismatch!");

              $form = $this->createForm(UserType::class, $user);
            //$form->addError(new FormError("Password mismatch"));
            return $this->render('user/register.html.twig', ['form' => $form->createView()]);
          }

            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $roleRepository = $this->getDoctrine()->getRepository(Role::class);
            $userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);

            $user->addRole($userRole);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash("info", "Wellcome " . $user->getFullName());

            return $this->redirectToRoute('homepage');
        }
        return $this->render('user/register.html.twig',['form' => $form->createView()]);
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
//        $form->add('wallet', NumberType::class, array(
//            'data' => $user->getWallet()
//        ));
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {

            if (($user->getPassword() != $user->getConfirm()) || ($user->getNewPassword() != $user->getConfirm())) {
                //$form->addError(new FormError("Password mismatch"));
                return $this->render('user/profile.html.twig', ['form' => $form->createView()]);
            }
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash("info", $user->getFullName() . "profile was successfully updated.");

            return $this->redirectToRoute('user_profile');
        }
        return $this->render("user/profile.html.twig", ['user' => $user, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}/edit", name="edit_profile")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @return RedirectResponse
     */
    public function editProfileAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $currentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager()->getRepository(User::class)->find($currentUser);

        $form = $this->createForm(UserType::class, $currentUser);
        $form->handleRequest($request);

        if($form->isValid()){
            //die();
            return $this->redirectToRoute('homepage');
        }



        //$form->remove('password');
        //$form->add('CurrentPassword', PasswordType::class, ['label' => 'Current password']);

    }

}
