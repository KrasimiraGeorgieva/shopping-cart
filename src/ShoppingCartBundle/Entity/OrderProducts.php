<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * OrderProductsType
 *
 * @ORM\Table(name="order_products")
 * @ORM\Entity(repositoryClass="ShoppingCartBundle\Repository\OrderProductsRepository")
 */
class OrderProducts
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $createdDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_deleted", type="boolean")
     */
    private $isDeleted;

    /**
     * Many OrderProductsType have One Product.
     *
     * @ManyToOne(targetEntity="ShoppingCartBundle\Entity\Product", inversedBy="orderedProducts")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $product;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="ShoppingCartBundle\Entity\User", inversedBy="orderedProducts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * OrderProducts constructor.
     */
    public function __construct()
    {
        $this->createdDate = new \DateTime('now');
        $this->isDeleted = false;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     * @return OrderProducts
     */
    public function setCreatedDate(\DateTime $createdDate): OrderProducts
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return OrderProducts
     */
    public function setProduct($product): OrderProducts
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return OrderProducts
     */
    public function setUser(User $user): OrderProducts
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     * @return OrderProducts
     */
    public function setIsDeleted(bool $isDeleted): OrderProducts
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}