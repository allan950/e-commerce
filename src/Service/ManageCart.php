<?php

namespace App\Service;

class ManageCart 
{
    private Array $cart;
    private float $total;

    public function __construct()
    {
        $this->cart = [
            "items" => [
                "item1" => [
                    "name" => "Top",
                    "price" => 23.00,
                    "quantity" => 1,
                ],
                "item2" => [
                    "name" => "Pants",
                    "price" => 12.00,
                    "quantity" => 2,
                ],
                "item3" => [
                    "name" => "Socks",
                    "price" => 5.99,
                    "quantity" => 5,
                ],
            ],
            "count" => 0,
        ];
    }

    public function getCart() {
        $this->updateCount();

        return $this->cart["items"];

    }

    public function getCount(): int {
        return $this->cart["count"];
    }

    private function updateCount() {
        $this->cart["count"] = count($this->cart["items"]);
    }

    private function calculateTotal() {
        $items = $this->cart["items"];

        $total = 0;

        foreach ($items as $item) {
            $total += $item["price"] * $item["quantity"];
        }

        $this->total = $total;
    }

    public function getTotal(): float {
        $this->calculateTotal();

        return $this->total;
    }

    static public function addItemToCart($product) {
        $items = ManageCart::$cart["items"];
        $isItemNew = true;

        foreach ($items as $item) {
            if ($product === $item) {
                $isItemNew = false;
                $item["quantity"] += 1;
            }
        }

        if ($isItemNew == true) {
            $items["item4"] = [
                "name" => "Socks",
                "price" => 5.99,
                "quantity" => 5,
            ];
        }

        ManageCart::$cart["items"] = $items;
    }

    public function removeItem() {

    }
}