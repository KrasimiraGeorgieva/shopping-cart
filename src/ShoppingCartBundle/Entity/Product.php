<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="ShoppingCartBundle\Repository\ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Please enter a product name")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message="Please enter a description")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(message="Please enter a price")
     * @Assert\Range(
     *     max="1000000",
     *     min="1.00",
     *     maxMessage="The product must not be more expensive than 1000000 dollars",
     *     minMessage="The product should cost at least 1.00 currency"
     * )
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", options={"default"=0})
     */
    private $quantity;

    /**
     * @var int
     *
     *@ORM\Column(name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    private $clientId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="ShoppingCartBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * One Product(item) have Many CartItems.
     *
     * @var ArrayCollection|Product[]
     * @ORM\OneToMany(targetEntity="ShoppingCartBundle\Entity\CartItem", mappedBy="item")
     *
     */
    private $cartItems;

    /**
     * One Product has Many Reviews.
     *
     * @var Review[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="ShoppingCartBundle\Entity\Review", mappedBy="product")
     */
    private $reviews;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->cartItems = new ArrayCollection();
        $this->reviews = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return bool
     */
    public function getStock(): ?bool
    {
        return $this->stock;
    }

    /**
     * @param bool $stock
     * @return Product
     */
    public function setStock(bool $stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     *
     * @return Product
     */
    public function setCategoryId(int $categoryId):Product
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     *
     * @return Product
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     *
     * @return Product
     */
    public function setClientId(int $clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return \ShoppingCartBundle\Entity\User
     */
    public function getClient()
    {
        return $this->client->getFullName();
    }


    /**
     * @param \ShoppingCartBundle\Entity\User $client
     *
     * @return Product
     */
    public function setClient(User $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ArrayCollection|CartItem[]
     */
    public function getCartItems()
    {
        return $this->cartItems;
    }

    /**
     * @param CartItem $cartItems
     * @return Product
     */
    public function setCartItems(CartItem $cartItems)
    {
        $this->cartItems = $cartItems;

        return $this;
    }

    /**
     * @return ArrayCollection|Review[]
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param ArrayCollection|Review[] $reviews
     * @return Product
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;

        return $this;
    }
}

