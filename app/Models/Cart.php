<?php

namespace App\Models;

class Cart {
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id, $quantity = 1) {
        $storedItem = ['qty' => 0, 'price' => 0, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] += $quantity;
        $storedItem['price'] = ($item->promotion_price > 0 ? $item->promotion_price : $item->unit_price) * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $quantity;
        $this->totalPrice += ($item->promotion_price > 0 ? $item->promotion_price : $item->unit_price) * $quantity;
    }

    public function reduceByOne($id) {
        if (array_key_exists($id, $this->items)) {
            $this->items[$id]['qty']--;
            $itemPrice = ($this->items[$id]['item']['promotion_price'] > 0) ? $this->items[$id]['item']['promotion_price'] : $this->items[$id]['item']['unit_price'];
            $this->items[$id]['price'] -= $itemPrice;
            if ($this->items[$id]['qty'] <= 0) {
                unset($this->items[$id]);
            }
            $this->updateTotals();
        }
    }

    public function removeItem($id) {
        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['price'];
            unset($this->items[$id]);
            $this->updateTotals();
        }
    }

    private function updateTotals() {
        $this->totalQty = 0;
        $this->totalPrice = 0;
        foreach ($this->items as $item) {
            $this->totalQty += $item['qty'];
            $this->totalPrice += $item['price'];
        }
    }
}
