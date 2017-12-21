<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShoppingCartBundle\Entity\Cart;
use ShoppingCartBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class OrderProductsController extends Controller
{
    /**
     * @Route("/{id}/", name="product_order")
     *
     * @Method("POST")
     * @param Request $request
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function orderAction(Request $request, Product $product)
    {
//        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
//
//
//
//        $product->getName();
//        $product->setQuantity($product);

        $cart = new Cart();

        $cart->getUser();
        $cart->getOrderProducts();
        $currentUser = $this->getUser();
        $cart->setUser($currentUser);

        $orderForm = $this->createForm(Cart::class, ['id' => $product->getId()]);
        $orderForm->handleRequest($request);

        if($orderForm->isSubmitted() && $orderForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($orderForm);
            $em->flush();
        }

//        $this->addFlash("success", $product->getQuantity() . $product->getName() . " successfully added.");


            //

        return $this->render(':product:index.html.twig');
    }



    /**
     * @param Product $product
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToCart(Product $product, Request $request)
    {
        $cart = new Cart();
        $currentUser = $this->getUser();
        $cart->setUser($currentUser);

        $orderForm = $this->createForm(Cart::class, ['id' => $product->getId()]);
        $orderForm->handleRequest($request);

        if($orderForm->isSubmitted() && $orderForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
        }

        $this->addFlash("success", $product->getQuantity() . $product->getName() . " successfully added.");

        return $this->redirectToRoute('cart_index', [
            'product' => $product,
            'currentUser' => $currentUser,
            'order_form' => $orderForm->createView()
        ]);
    }
}
