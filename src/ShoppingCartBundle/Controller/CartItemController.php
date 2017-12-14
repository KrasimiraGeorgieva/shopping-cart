<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShoppingCartBundle\Entity\CartItem;
use ShoppingCartBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartItemController extends Controller
{
    /**
     * @Route("/cartItem", name="cartItem_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        return $this->render('cartItem/index.html.twig');
    }

//    /**
////     * @Route(/cartItems/add/{id}, name="cart_items_add", requirements={"id":"\d+"})
//     * @param Product $quantity
//     */
//    public function addItemsToCart(Product $quantity)
//    {
////        $em = $this->getDoctrine()->getManagerForClass(Product::class);
////        $itemRepository = $em->getRepository('ShoppingCartBundle:CartItem');
////        if(!$item = $itemRepository->find($quantity)){
////            throw $this->createNotFoundException();
////        }
//
////        $cartItem = new CartItem();
////        $cartItem->setItem($quantity);
////        $cartItem->getOrderQuantity();
////
////        $em = $this->getDoctrine()->getManager();
////        $em->persist($cartItem);
////        $em->flush();
////
////        return $this->redirectToRoute('');
//
//    }
}
