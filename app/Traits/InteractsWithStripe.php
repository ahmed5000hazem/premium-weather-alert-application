<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Laravel\Cashier\Cashier;

trait InteractsWithStripe
{
    public function stripeProducts(): Collection
    {
        $stripe = Cashier::stripe();
        $products = $stripe->products->all(); // here you get all products
        $prices   = $stripe->prices->all();   // here you get all prices

        $items = []; // init empty array 

        // Loop though each product and create your own schema
        foreach($products->data as $product):
            $key = $product->id;
            $tier = $product->name;
            $items[$key] = [];
            $items[$key]['id']   = $product->id;
            $items[$key]['tier'] = $tier;
            $items[$key]['name'] = $product->name;
            $items[$key]['description'] = $product->description;
            $items[$key]['prices'] = collect();
        endforeach;

        // now we need to add the existing prices for the products
        foreach($prices->data as $price):
            if($price->active == false) continue; // skip all archived prices 

            $items[$price->product]['prices']->push((object) [
                'id' => $price->id,
                'price' => $price->unit_amount,
            ]);
        endforeach;

        return collect(array_values($items));
    }
}
