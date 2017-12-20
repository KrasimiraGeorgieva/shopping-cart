<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShoppingCartBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class OrderProductsController extends Controller
{
//    /**
//     * @Route("/{id}/", name="product_order")
//     *
//     * @Method("GET")
//     * @param Product $product
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function orderAction()
//    {
//
////        $form = $this->createForm('ShoppingCartBundle\Form\ProductType', $product);
////        //$product = $this->getDoctrine()->getRepository(Product::class)->find($id);
////        //$product->getName();
////
////
////        $form->handleRequest($request);
////
//        return $this->render(':product:index.html.twig');
//    }
}
