<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BanIp
 *
 * @ORM\Table(name="ban_ips")
 * @ORM\Entity(repositoryClass="ShoppingCartBundle\Repository\BanIpRepository")
 */
class BanIp
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
     * @ORM\Column(name="ip_address", type="string", length=20)
     */
    private $ipAddress;

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
     * Set ipAddress
     *
     * @param string $ipAddress
     *
     * @return BanIp
     */
    public function setIpAddress(string $ipAddress): BanIp
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }
}