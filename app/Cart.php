<?php

namespace App;

class Cart
{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;


    public function __construct($oldCart)
    {

        if($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;

        }
     }        

     public function add($item, $id)
     {
        $storedItem = ['qty' => 0,'price'=>$item->stock_price, 'item' =>$item];
        if($this->items)
        {
            if(array_key_exists($id,$this->items))
            {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->stock_price * $storedItem['qty'];

        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->stock_price;

     }

     public function updatePriceAndQuantity()
     {
        $totalPrice = 0;
        $totalQty = 0;

        foreach($this->items as $item)
        {
            $totalQty = $totalQty + $item['qty'];
            $totalPrice = $totalPrice + $item['price'];
        }
        $this->totalQty = $totalQty;
        $this->totalPrice =  $totalPrice;
        
     }
}

