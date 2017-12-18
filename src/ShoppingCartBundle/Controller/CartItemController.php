<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\CartItem;
use ShoppingCartBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cartitem controller.
 *
 * @Route("cartitem")
 */
class CartItemController extends Controller
{
    /**
     * Lists all cartItem entities.
     *
     * @Route("/", name="cartitem_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cartItems = $em->getRepository('ShoppingCartBundle:CartItem')->findAll();

        return $this->render('cartitem/index.html.twig', array(
            'cartItems' => $cartItems,
        ));
    }

    /**
     * Creates a new cartItem entity.
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/new", name="cartitem_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {


        /**@var User */
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        /**@var Product */
        //$product = $this->getDoctrine()->getRepository(Product::class)->find($id);


        /**@var CartItem */
        $cartItem = new CartItem();
        $cartItem->setUser($user);





        $form = $this->createForm('ShoppingCartBundle\Form\CartItemType', $cartItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cartItem);
            $em->flush();

            return $this->redirectToRoute('cartitem_show', array('id' => $cartItem->getId()));
        }

        return $this->render('cartitem/new.html.twig', array(
            'cartItem' => $cartItem,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cartItem entity.
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/{id}", name="cartitem_show")
     *
     * @Method("GET")
     * @param CartItem $cartItem
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(CartItem $cartItem)
    {
        $deleteForm = $this->createDeleteForm($cartItem);

        return $this->render('cartitem/show.html.twig', array(
            'cartItem' => $cartItem,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cartItem entity.
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/{id}/edit", name="cartitem_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param CartItem $cartItem
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, CartItem $cartItem)
    {
        $deleteForm = $this->createDeleteForm($cartItem);
        $editForm = $this->createForm('ShoppingCartBundle\Form\CartItemType', $cartItem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cartitem_edit', array('id' => $cartItem->getId()));
        }

        return $this->render('cartitem/edit.html.twig', array(
            'cartItem' => $cartItem,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Deletes a cartItem entity.
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/{id}", name="cartitem_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param CartItem $cartItem
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, CartItem $cartItem)
    {
        $form = $this->createDeleteForm($cartItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cartItem);
            $em->flush();
        }

        return $this->redirectToRoute('cartitem_index');
    }

    /**
     * Creates a form to delete a cartItem entity.
     *
     * @param CartItem $cartItem The cartItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CartItem $cartItem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cartitem_delete', array('id' => $cartItem->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
