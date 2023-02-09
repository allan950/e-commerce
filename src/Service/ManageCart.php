<?php

namespace App\Service;

class ManageCart 
{

    private Array $cart;
    private float $total;
    private float $totalTTC;

    public function __construct()
    {
        $this->cart = [
            "items" => [],
            "count" => 0,
        ];
    }

    public function getCart() {
        //$this->updateCount();

        return $this->cart["items"];

    }

    public function getCount(): int {
        return count($this->cart['items']);
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

    public function getTotalTTC() {
        $totalHt = $this->getTotal();
        $totalTtc = $totalHt * 1.2;

        $this->totalTTC = $totalTtc;

        return $this->totalTTC;
    }

    public function addItemToCart($product) {
        $items = $this->cart["items"];
        $isItemNew = true;

        foreach ($items as $keys => $item) {
            if ($product["name"] === $item["name"] && $product["id"] === $item["id"]) {
                $isItemNew = false;
                $items[$keys]["quantity"] += 1;
            }
        }

        if ($isItemNew == true) {
            array_push($items, $product);
        }

        $this->cart["items"] = $items;
    }

    public function removeItem() {

    }
}