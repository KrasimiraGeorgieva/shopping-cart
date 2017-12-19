<?php
declare (strict_types =1);
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
     * @Assert\NotBlank(message="Please, upload the product image as a JPG file.")
     * @Assert\Image(mimeTypes={ "application/jpg" })
     *
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

//    /**
//     * @var bool
//     *
//     * @ORM\Column(name="owner_of_product", type="boolean")
//     */
//    private $ownerOfProduct;

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
     * One Product has Many OrderProducts.
     *
     * @var OrderProducts[]|ArrayCollection
     * @OneToMany(targetEntity="ShoppingCartBundle\Entity\OrderProducts", mappedBy="product")
     */
    private $orderProducts;


    /**
     * One Product has Many Reviews.
     *
     * @var Review[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="ShoppingCartBundle\Entity\Review", mappedBy="product")
     */
    private $reviews;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->orderProducts = new ArrayCollection();
        $this->stock = 1;
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
    public function setStock(int $stock)
    {
        $this->stock = $stock;

        return $this;
    }

//    /**
//     * @return bool
//     */
//    public function getOwnerOfProduct(): bool
//    {
//        return $this->ownerOfProduct;
//    }
//
//    /**
//     * @param bool $ownerOfProduct
//     *
//     * @return Product
//     */
//    public function setOwnerOfProduct(bool $ownerOfProduct)
//    {
//        $this->ownerOfProduct = $ownerOfProduct;
//
//        return $this;
//    }

    /**
     * Set quantity
     *
     * @param $quantity
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

    /**
     * @return ArrayCollection|OrderProducts[]
     */
    public function getOrderProducts()
    {
        return $this->orderProducts;
    }

    /**
     * @param ArrayCollection|OrderProducts[] $orderProducts
     */
    public function setOrderProducts($orderProducts)
    {
        $this->orderProducts = $orderProducts;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

}

