<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\ManyToOne(inversedBy: 'order')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $client = null;

    #[ORM\Column]
    private ?float $totalPriceHt = null;

    #[ORM\Column]
    private ?float $totalPriceTtc = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $items = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTotalPriceHt(): ?float
    {
        return $this->totalPriceHt;
    }

    public function setTotalPriceHt(float $totalPriceHt): self
    {
        $this->totalPriceHt = $totalPriceHt;

        return $this;
    }

    public function getTotalPriceTtc(): ?float
    {
        return $this->totalPriceTtc;
    }

    public function setTotalPriceTtc(float $totalPriceTtc): self
    {
        $this->totalPriceTtc = $totalPriceTtc;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
