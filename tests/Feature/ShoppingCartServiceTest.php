<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\services\Contracts\DeliveryInterface;
use App\services\ShoppingCartService;
use Mockery;
use PHPUnit\Framework\TestCase;

class ShoppingCartServiceTest extends TestCase
{
    /**
     * @test
     */
    public function givenAddShirtAndShoeProductsToCartWhenProductsQuantityIsOneThenResultsInACartWithTwoProducts()
    {
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $shoppingCartService = new ShoppingCartService($deliveryService);

        $shoppingCart = $this->setEmptyShoppingCart();
        $shirt = $this->setShirt();
        $shoe = $this->setShoe();
        $quantity = 1;

        $expected = [
            0 => ['id' => 1, 'quantity' => $quantity, 'price' => 10],
            1 => ['id' => 2, 'quantity' => $quantity, 'price' => 15],
        ];

        $updatedShoppingCart = $shoppingCartService->addProductQuantity($shoppingCart, $shirt, $quantity);
        $updatedShoppingCart = $shoppingCartService->addProductQuantity($updatedShoppingCart, $shoe, $quantity);

        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     */
    public function givenRemoveProductInCartWhenProductQuantityIsTwoThenTheProductQuantityIsOne()
    {
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $shoppingCartService = new ShoppingCartService($deliveryService);
        $shoppingCart = $this->setEmptyShoppingCart();
        $shoe = $this->setShoe();

        $shoppingCart->products = [
            0 => ['id' => 1, 'quantity' => 2, 'price' => 10],
            1 => ['id' => 2, 'quantity' => 2, 'price' => 15],
        ];

        $expected = [
            0 => ['id' => 1, 'quantity' => 2, 'price' => 10],
            1 => ['id' => 2, 'quantity' => 1, 'price' => 15],
        ];

        $updatedShoppingCart = $shoppingCartService->removeProductQuantity($shoppingCart, $shoe, 1);

        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     */
    public function givenRemoveProductQuantityWhenQuantityIsGreaterThanCartQuantity()
    {
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $shoppingCartService = new ShoppingCartService($deliveryService);

        $shoppingCart = $this->setEmptyShoppingCart();
        $shoe = $this->setShirt();
        $quantityToRemove = 3;

        $shoppingCart->products = [
            0 => ['id' => 1, 'quantity' => 2, 'price' => 10],
        ];

        $expected = [
            0 => ['id' => 1, 'quantity' => 0, 'price' => 10],
        ];

        $updatedShoppingCart = $shoppingCartService->removeProductQuantity($shoppingCart, $shoe, $quantityToRemove);

        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     */
    public function givenEmptyCartWhenCartHaveSomeProductsThenReturnEmptyArray()
    {
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $shoppingCartService = new ShoppingCartService($deliveryService);
        $shoppingCart = $this->setEmptyShoppingCart();
        $expected = [];

        $shoppingCart->products = [
            0 => ['id' => 1, 'quantity' => 2, 'price' => 10],
        ];

        $updatedShoppingCart = $shoppingCartService->emptyCart($shoppingCart);

        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     */
    public function givenSetCartProductsWhenCartIsEmptyThenSumCarProductsValueAndReturnsThirtyFive()
    {
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $deliveryService->shouldReceive('setDeliveryCost')->with('87020-030')->andReturn(10);
        $shoppingCartService = new ShoppingCartService($deliveryService);
        $shoppingCart = $this->setEmptyShoppingCart();
        $userAddress = '87020-030';
        $expected = 35;

        $shoppingCart->products = [
            0 => ['id' => 1, 'quantity' => 1, 'price' => 10],
            1 => ['id' => 2, 'quantity' => 1, 'price' => 15],
        ];

        $totalPrice = $shoppingCartService->recalculateShoppingCart($shoppingCart, $userAddress);

        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @test
     */
    public function givenRecalculateShoppingCartWhenCartIsEmptyThenFinalValueReturnsZero()
    {
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $deliveryService->shouldReceive('setDeliveryCost')->with('87020-030')->andReturn(10.50);
        $shoppingCartService = new ShoppingCartService($deliveryService);
        $shoppingCart = $this->setEmptyShoppingCart();

        $finalValue = $shoppingCartService->recalculateShoppingCart($shoppingCart, '87020-030');

        $this->assertTrue($finalValue == 0);
    }

    private function setEmptyShoppingCart(): ShoppingCart
    {
        $shoppingCart = new ShoppingCart();
        $shoppingCart->products = [];

        return $shoppingCart;
    }

    private function setShirt(): Product
    {
        $shirt = new Product();
        $shirt->id = 1;
        $shirt->description = 'Camiseta';
        $shirt->price = 10;

        return $shirt;
    }

    private function setShoe(): Product
    {
        $shoe = new Product();
        $shoe->id = 2;
        $shoe->description = 'Sapato';
        $shoe->price = 15;

        return $shoe;
    }
}
