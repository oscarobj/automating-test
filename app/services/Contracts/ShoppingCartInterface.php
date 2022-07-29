<?php

namespace App\services\Contracts;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;

interface ShoppingCartInterface
{
    function emptyCart(ShoppingCart $shoppingCart): ShoppingCart;
    function addProduct(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart;
    function removeProduct(ShoppingCart $shoppingCart, Product $product): ShoppingCart;
    function addProductQuantity(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart;
    function removeProductQuantity(ShoppingCart $shoppingCart, Product $product, int $productQuantity): ShoppingCart;
    function recalculateShoppingCart(ShoppingCart $shoppingCart, User $user): float;
    function cartHasProduct(ShoppingCart $shoppingCart, Product $product): bool;
}
