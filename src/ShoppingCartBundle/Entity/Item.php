<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Item
 *
 * @ORM\Table(name="items")
 * @ORM\Entity(repositoryClass="ShoppingCartBundle\Repository\CartRepository")
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="orderQuantity", type="integer")
     */
    private $orderQuantity;

    /**
     *  Many Items have One CartItems.
     *
     * @ManyToOne(targetEntity="ShoppingCartBundle\Entity\CartItem")
     * @JoinColumn(name="cartItem_id", referencedColumnName="id")
     */
    private $cartItem;

    /**
     *  Many Items have One Product.
     *
     * @ManyToOne(targetEntity="ShoppingCartBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;


    /**
     * @ORM\ManyToOne(targetEntity="ShoppingCartBundle\Entity\User", inversedBy="items")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")")
     */
    private $customer;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderQuantity
     *
     * @param integer $orderQuantity
     *
     * @return Item
     */
    public function setOrderQuantity(int $orderQuantity)
    {
        $this->orderQuantity = $orderQuantity;

        return $this;
    }

    /**
     * Get orderQuantity
     *
     * @return int
     */
    public function getOrderQuantity()
    {
        return $this->orderQuantity;
    }

    /**
     * @return CartItem
     */
    public function getCartItem()
    {
        return $this->cartItem;
    }

    /**
     * @param CartItem $cartItem
     *
     */
    public function setCartItem($cartItem)
    {
        $this->cartItem = $cartItem;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     */
    public function setProduct($product)
    {
        $this->product = $product;

    }

    /**
     * @return User
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param User
     *
     */
    public function setCustomer(User $customer)
    {
        $this->customer = $customer;

    }


}

