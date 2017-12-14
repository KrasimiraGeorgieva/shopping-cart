<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * CartItem
 *
 * @ORM\Table(name="cart_items")
 * @ORM\Entity(repositoryClass="ShoppingCartBundle\Repository\CartItemRepository")
 */
class CartItem
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
     * @var string
     *
     * @ORM\Column(name="totalPrice", type="decimal", precision=10, scale=2)
     */
    private $totalPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetimetz")
     */
    private $createdDate;

    /**
     *  Many CartItems have One User.
     *
     * @ManyToOne(targetEntity="ShoppingCartBundle\Entity\User", inversedBy="cartItems")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     *  Many CartItems have One Product(item).
     *
     * @ManyToOne(targetEntity="ShoppingCartBundle\Entity\Product", inversedBy="cartItems")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $item;



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
     * @return CartItem
     */
    public function setOrderQuantity($orderQuantity)
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
     * Set totalPrice
     *
     * @param string $totalPrice
     *
     * @return CartItem
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return CartItem
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Product
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param Product $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }
}

