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

        //verifica se o carrinho está vazio
        if (empty($shoppingCart->products)) {
            $products = [['id' => $product->id, 'quantity' => $productQuantity, 'price' => $product->price]];
        } else {
            foreach ($shoppingCart->products as $key => $value) {
                //verifica se o produto já existe
                if ($value['id'] == $product->id) {
                    // Somar qunatidade presente à quantidade passada por parâmetro
                    $shoppingCart->products[$key]['quantity'] += $productQuantity;
                } else {
                    // Adicionar produto
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

        // Executar ação apenas se o produto existir no carrinho
        foreach ($products as $key => $value) {
        // verifica se o produto já existe
            if ($value['id'] == $product->id) {
                // Se a quantidade a ser subtraída for maior do que a quantidade presente no carrinho, a quantidade final será zero.
                if ($productQuantity > $products[$key]['quantity']) {
                    $products[$key]['quantity'] = 0;
                    // Senão, subtrai-se a quantidade passada por parâmetro da quantidade presente no carrinho
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
        $shippingChargeLimit = 100; // definicão do limite máximo para cobrança de frete

        //calcular valor base do carrinho de compras
        foreach ($shoppingCart->products as $product) {
            $totalPrice += $product['quantity'] * $product['price'];
        }

        // se o frete for menor que 100, soma-se o valor de frete
        if ($totalPrice > 0 && $totalPrice <= $shippingChargeLimit) {
            return $totalPrice + $this->deliveryInterface->setDeliveryCost($userAddress);
        }

        // senão, a compra é isenta de frete
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
