<?php

namespace App\services;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use App\services\Contracts\DeliveryInterface;
use App\services\Contracts\ShoppingCartInterface;

class ShoppingCartService implements ShoppingCartInterface
{
    private DeliveryInterface $deliveryInterface;

    public function __construct(DeliveryInterface $deliveryInterface)
    {
        $this->deliveryInterface = $deliveryInterface;
    }

    /**
     * @param ShoppingCart $shoppingCart
     * @param Product $product
     * @param int $productQuantity
     * @return ShoppingCart
     */
    function addProductQuantity(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart
    {
        $products = $shoppingCart->products;

        if (empty($shoppingCart->products)) {
            $products = [['id' => $product->id, 'quantity' => $productQuantity, 'price' => $product->price]];
        } else {
            foreach ($shoppingCart->products as $key => $value) {
                if ($value['id'] == $product->id) {
                    $shoppingCart->products[$key]['quantity'] += $productQuantity;
                } else {
                    $products[] = ['id' => $product->id, 'quantity' => $productQuantity, 'price' => $product->price];
                }
            }
        }
        $shoppingCart->products = $products;
        return $shoppingCart;
    }

    /**
     * @param ShoppingCart $shoppingCart
     * @param Product $product
     * @param int $productQuantity
     * @return ShoppingCart
     */
    function removeProductQuantity(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart
    {
        $products = $shoppingCart->products;

        foreach ($products as $key => $value) {
            if ($value['id'] == $product->id) {
                if ($productQuantity > $products[$key]['quantity']) {
                    $products[$key]['quantity'] = 0;
                } else {
                    $products[$key]['quantity'] -= $productQuantity;
                }
            }
        }
        $shoppingCart->products = $products;

        return $shoppingCart;
    }

    /**
     * @param ShoppingCart $shoppingCart
     * @return ShoppingCart
     */
    function emptyCart(ShoppingCart $shoppingCart): ShoppingCart
    {
        if (!empty($shoppingCart->products))
            $shoppingCart->products = [];

        return $shoppingCart;
    }

    /**
     * @param ShoppingCart $shoppingCart
     * @param $userAddress
     * @return float
     */
    function recalculateShoppingCart(ShoppingCart $shoppingCart, $userAddress): float
    {
        $totalPrice = 0;
        $shippingChargeLimit = 100;

        foreach ($shoppingCart->products as $product) {
            $totalPrice += $product['quantity'] * $product['price'];
        }

        if ($totalPrice > 0 && $totalPrice <= $shippingChargeLimit) {
            return $totalPrice + $this->deliveryInterface->setDeliveryCost($userAddress);
        }

        return $totalPrice;
    }

    public function cartHasSpecificProduct(ShoppingCart $shoppingCart, Product $product): bool
    {
        foreach ($shoppingCart->products as $key => $product) {
            if (key($product) == $product->id) {
                return true;
            }
        }

        return false;
    }

}
