<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="IDX_E52FFDEE19EB6921", columns={"client_id"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;

    /**
     * @var \LineOrder
     * @ORM\OneToMany(targetEntity="LineOrder", mappedBy="order")
     */
    private $lineOrders;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Add LineOrder.
     *
     * @param LineOrder $lineOrder
     *
     * @return Orders
     */
    public function addLineOrder(LineOrder $lineOrder)
    {
        $this->lineOrders[] = $lineOrder;

        return $this;
    }

    /**
     * Remove LineOrder.
     *
     * @param LineOrder $lineOrder
     *
     * @return boolean
     */
    public function removeLineOrder(LineOrder $lineOrder)
    {
        return $this->lineOrders->removeElement($lineOrder);
    }

    /**
     * Get LineOrder.
     */
    public function getLineOrders()
    {
        return $this->lineOrders;
    }

}
