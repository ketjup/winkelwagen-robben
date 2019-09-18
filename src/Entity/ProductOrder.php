<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductOrderRepository")
 */
class ProductOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_ID;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="productOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_ID;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductID(): ?Product
    {
        return $this->product_ID;
    }

    public function setProductID(?Product $product_ID): self
    {
        $this->product_ID = $product_ID;

        return $this;
    }

    public function getOrderID(): ?Order
    {
        return $this->order_ID;
    }

    public function setOrderID(?Order $order_ID): self
    {
        $this->order_ID = $order_ID;

        return $this;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }
}
