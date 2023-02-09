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
    private ?\DateTimeInterface $order_date = null;

    #[ORM\ManyToOne(inversedBy: 'quantity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $client = null;

    #[ORM\Column]
    private ?float $total_price_ht = null;

    #[ORM\Column]
    private ?float $total_price_ttc = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $items = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->order_date;
    }

    public function setOrderDate(\DateTimeInterface $order_date): self
    {
        $this->order_date = $order_date;

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
        return $this->total_price_ht;
    }

    public function setTotalPriceHt(float $total_price_ht): self
    {
        $this->total_price_ht = $total_price_ht;

        return $this;
    }

    public function getTotalPriceTtc(): ?float
    {
        return $this->total_price_ttc;
    }

    public function setTotalPriceTtc(float $total_price_ttc): self
    {
        $this->total_price_ttc = $total_price_ttc;

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
