<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
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
     * @var double
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(message="Please enter a price")
     * @Assert\Range(
     *     max="1000000",
     *     min="1.00",
     *     maxMessage="The product must not be more expensive than 1000000 currency",
     *     minMessage="The product should cost at least 1.00 currency"
     * )
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     *
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
     * @ORM\Column(name="category_id", type="integer")
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
     * One Product has Many OrderProductsType.
     *
     * @var OrderProducts[]|ArrayCollection
     * @OneToMany(targetEntity="ShoppingCartBundle\Entity\OrderProducts", mappedBy="product")
     */
    private $orderedProducts;

    /**
     * One Product has Many Carts.
     *
     * @var ArrayCollection
     * @OneToMany(targetEntity="ShoppingCartBundle\Entity\Cart", mappedBy="product")
     */
    private $productCarts;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->productCarts = new ArrayCollection();
        $this->orderedProducts = new ArrayCollection();
        $this->stock = 1;
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name): Product
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
    public function setDescription($description): Product
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
    public function setPrice($price): Product
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
    public function setImage($image): Product
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
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return Product
     */
    public function setStock(int $stock): Product
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Set quantity
     *
     * @param $quantity
     *
     * @return Product
     */
    public function setQuantity(int $quantity): Product
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
    public function setCategoryId(int $categoryId): Product
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
    public function setCategory(Category $category = null): Product
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param $clientId
     *
     * @return Product
     */
    public function setClientId(int $clientId): Product
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
    public function setClient(User $client = null): Product
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductCarts(): ArrayCollection
    {
        return $this->productCarts;
    }

    /**
     * @param ArrayCollection $productCarts
     */
    public function setProductCarts(ArrayCollection $productCarts)
    {
        $this->productCarts = $productCarts;
    }

    /**
     * @return ArrayCollection|OrderProducts[]
     */
    public function getOrderedProducts()
    {
        return $this->orderedProducts;
    }

    /**
     * @param ArrayCollection|OrderProducts[] $orderedProducts
     */
    public function setOrderedProducts($orderedProducts)
    {
        $this->orderedProducts = $orderedProducts;
    }
}