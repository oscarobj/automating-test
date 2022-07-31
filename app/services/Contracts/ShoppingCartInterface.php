<?php

namespace App\services\Contracts;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;

interface ShoppingCartInterface
{
    function emptyCart(ShoppingCart $shoppingCart): ShoppingCart;
    function addProductQuantity(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart;
    function removeProductQuantity(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart;
    function recalculateShoppingCart(ShoppingCart $shoppingCart, $userAddress): float;
    function cartHasSpecificProduct(ShoppingCart $shoppingCart, Product $product): bool;
}
