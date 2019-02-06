<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\Cart;
use ShoppingCartBundle\Entity\OrderProducts;
use ShoppingCartBundle\Entity\Product;
use ShoppingCartBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CartController
 * @package ShoppingCartBundle\Controller
 */
class CartController extends Controller
{
    /**
     * Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/product/{id}/cart", name="add_to_cart")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToCartAction(Product $product)
    {
        $user = $this->getUser();
        $cart = new Cart();
        $cart->setUser($user);
        $cart->setProduct($product);

        if($product->getQuantity() === 0) {
            $this->addFlash('info', 'Not enough product quantity.');
            return $this->redirectToRoute('homepage');
        }

        $product->setQuantity($product->getQuantity() - 1);

        if ($user->isClient($product)) {
            $this->addFlash('info', 'You are creator of the ' . $product->getName() . '. It can not be added to the cart.');
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($cart);
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('cart_products');
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/cart/products", name="cart_products")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cartProductsAction()
    {
        $em = $this->getDoctrine()->getRepository(Cart::class);
        $userCart = $em->findBy(['user' => $this->getUser(), 'isDeleted' => false]);
        $products = array_map(
            function (Cart $cart) {
                return $cart->getProduct();
            },
            $userCart);
        $totalSum = array_reduce($products,
            function (&$res, Product $p) {
                return $res += $p->getPrice();
            },
            0);

        return $this->render('cart\index.html.twig', [
            'products' => $products,
            'total' => $totalSum,
            'user' => $this->getUser()->getFullName()]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/cart/products/{id}/remove", name="cart_products_remove")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeProductFromCartAction(Product $product)
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var Cart $productFromCart */
        $productFromCart = $this->getDoctrine()->getRepository(Cart::class)
            ->findOneBy(['user' => $user, 'product' => $product, 'isDeleted' => false]);
        $productFromCart->setIsDeleted(true);

        $product->setQuantity($product->getQuantity() + 1);
        if($product->getQuantity() === 1) {
            $product->setStock(1);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($productFromCart);
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('cart_products');
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/cart/product/{id}/buy", name="cart_product_buy")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function buyOneProductFromCartAction(Product $product)
    {
        /** @var User $user */
        $user = $this->getUser();

        $orderProduct = new OrderProducts();
        $orderProduct->setUser($user);
        $orderProduct->setProduct($product);

        $user->setMoneySpent($user->getMoneySpent() + $product->getPrice());
        $user->setWallet($user->getWallet() - $product->getPrice());

        $product->setQuantity($product->getQuantity() - 1);
        if($product->getQuantity() <= 0) {
            $product->setStock(0);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($orderProduct);
        $em->persist($user);
        $em->persist($product);
        $em->flush();

        return $this->removeProductFromCartAction($product);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/cart/products/buy-all", name="cart_products_buy_all")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function buyAllProductFromCartAction()
    {
        $em = $this->getDoctrine()->getRepository(Cart::class);
        $productsInCart = $em->findBy(['user' => $this->getUser(), 'isDeleted' => false]);

        if(count($productsInCart)){
            foreach ($productsInCart as $productInCart){
                $this->buyOneProductFromCartAction($productInCart->getProduct());
            }
            return $this->redirectToRoute('user_orders');
        }
        return $this->redirectToRoute('homepage');
    }
}