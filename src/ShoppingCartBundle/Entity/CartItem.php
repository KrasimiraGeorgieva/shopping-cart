<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var double
     *
     * @ORM\Column(name="totalPrice", type="decimal", precision=10, scale=2)
     */
    private $totalPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime")
     */
    private $createdDate;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @Assert\Length(
     * min = 2,
     * max = 150,
     * minMessage = "Your first name must be at least 2 characters long",
     * maxMessage = "Your first name cannot be longer than 150 characters"
     * )
     *
     * @ORM\Column(name="contact_name", type="string", length=150)
     */
    private $contactName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your phone number must be at least 8 digits",
     *      maxMessage = "Your phone number cannot be longer than 50 digits"
     * )
     *
     * @ORM\Column(name="phone_number", type="string", length=50)
     */
    private $phoneNumber;

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
     * CartItem constructor.
     */
    public function __construct()
    {
        $this->createdDate = new \DateTime('now');
        $this->status = 0;
        $this->item = new ArrayCollection();
        $this->user = new ArrayCollection();
    }


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
     * @param double $totalPrice
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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return CartItem
     */
    public function setStatus(int $status = 1)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * @param string $contactName
     *
     * @return CartItem
     */
    public function setContactName(string $contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return CartItem
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return ArrayCollection|User[]
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
     * @return ArrayCollection|Item[]
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

