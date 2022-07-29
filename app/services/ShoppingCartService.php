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
    function addProduct(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart
    {
        $alreadyExists = $this->cartHasProduct($shoppingCart, $product);

        if (!$alreadyExists) {
            $shoppingCart->products[] = [
                $product->id => $productQuantity
            ];
        }

        return $shoppingCart;
    }

    /**
     * @param ShoppingCart $shoppingCart
     * @param Product $product
     * @return ShoppingCart
     */
    function removeProduct(ShoppingCart $shoppingCart, Product $product): ShoppingCart
    {
        // Executar ação apenas se o produto existir no carrinho
        foreach ($shoppingCart->products as $key => $product) {
            if (key($product) == $product->id) {
                // remover produto do carrinho
                unset($shoppingCart->products[$key]);
            }
        }
        return $shoppingCart;
    }

    /**
     * @param ShoppingCart $shoppingCart
     * @param Product $product
     * @param int $productQuantity
     * @return ShoppingCart
     */
    function addProductQuantity(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart
    {
        // Executar ação apenas se o produto existir no carrinho
        foreach ($shoppingCart->products as $key => $product) {
            if (key($product) == $product->id) {
                // Somar qunatidade presente à quantidade passada por parâmetro
                $shoppingCart->products[$key]['quantity'] += $productQuantity;
            }
        }

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
        // Executar ação apenas se o produto existir no carrinho
        foreach ($shoppingCart->products as $key => $product) {
            if (key($product) == $product->id) {
                // Se a quantidade a ser subtraída for maior do que a quantidade presente no carrinho, a quantidade final será zero.
                if ($productQuantity > $shoppingCart->products[$key]['quantity']) {
                    $shoppingCart->products[$key]['quantity'] = 0;
                    // Senão, subtrai-se a quantidade passada por parâmetro da quantidade presente no carrinho
                } else {
                    $shoppingCart->products[$key]['quantity'] -= $productQuantity;
                }
            }
        }
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
     * @param User $user
     * @return float
     */
    function recalculateShoppingCart(ShoppingCart $shoppingCart, User $user): float
    {
        $totalPrice = 0;
        $shippingChargeLimit = 100; // definicão do limite máximo para cobrança de frete

        //calcular valor base do carrinho de compras
        foreach ($shoppingCart->products as $product) {
            $totalPrice += $product['quantity'] * $product['price'];
        }

        // se o frete for menor que 100, soma-se o valor de frete
        if ($totalPrice <= $shippingChargeLimit) {
            return $totalPrice + $this->deliveryInterface->setDeliveryCost($user->address);
        }

        // senão, a compra é isenta de frete
        return $totalPrice;
    }

    public function cartHasProduct(ShoppingCart $shoppingCart, Product $product): bool
    {
        foreach ($shoppingCart->products as $key => $product) {
            if (key($product) == $product->id) {
                return true;
            }
        }

        return false;
    }

}
