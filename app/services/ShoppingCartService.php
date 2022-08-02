<?php

namespace App\services;

use App\Http\Enums\ShoppingCartOperations;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\services\Contracts\DeliveryInterface;
use App\services\Contracts\ShoppingCartInterface;

class ShoppingCartService implements ShoppingCartInterface
{
    /**
     * @var DeliveryInterface
     */
    private DeliveryInterface $deliveryInterface;

    /**
     * @param DeliveryInterface $deliveryInterface
     */
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

        if (empty($products)) {
            $products = [['id' => $product->id, 'quantity' => $productQuantity, 'price' => $product->price]];
        } else {
            $products = $this->updateOrRemoveProduct($products, $product, $productQuantity, ShoppingCartOperations::Add);
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
        $products = $this->updateOrRemoveProduct($products, $product, $productQuantity, ShoppingCartOperations::Remove);
        $shoppingCart->products = $products;

        return $shoppingCart;
    }

    /**
     * @param array $products
     * @param $product
     * @param $productQuantity
     * @param ShoppingCartOperations $operation
     * @return array
     */
    public function updateOrRemoveProduct(array $products, $product, $productQuantity, ShoppingCartOperations $operation): array
    {
        foreach ($products as $key => $value) {
            if ($value['id'] == $product->id) {

                if ($operation == ShoppingCartOperations::Add) {
                    $products[$key]['quantity'] += $productQuantity;
                } else {
                    $products[$key]['quantity'] = $productQuantity > $products[$key]['quantity'] ? 0 : $products[$key]['quantity'] -= $productQuantity;
                }

            } else {
                if ($operation == ShoppingCartOperations::Add)
                    $products[] = ['id' => $product->id, 'quantity' => $productQuantity, 'price' => $product->price];
            }
        }

        return $products;
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

    /**
     * @param ShoppingCart $shoppingCart
     * @param Product $product
     * @return bool
     */
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
