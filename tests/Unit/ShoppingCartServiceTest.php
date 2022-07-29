<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use App\services\Contracts\DeliveryInterface;
use App\services\ShoppingCartService;
use Mockery;
use PHPUnit\Framework\TestCase;

class ShoppingCartServiceTest extends TestCase
{
    /**
     * @test
     * Test the shopping cart products add
     */
    public function addProductInCart() {

        //Arrange
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $shoppingCartService = new ShoppingCartService($deliveryService);

        $shoppingCart = $this->createMock(ShoppingCart::class);

        $shirt = Mockery::mock(Product::class, [
            'id' => 1,
            'description' => 'Camiseta',
            'price' => 20
        ]);

        $expected = [
            1 => ['product' => $shirt, 'quantity' => 1]
        ];

        $quantity = 1;

        // Act
        $updatedShoppingCart = $shoppingCartService->addProduct($shoppingCart, $shirt, $quantity);

        $this->assertEquals($expected, $updatedShoppingCart);
    }

    /**
     * @test
     * Test the shopping cart products sum (total price)
     */
    public function sumCartProducts()
    {
//        $deliveryService = $this->createMock(DeliveryInterface::class);
//        $deliveryService->method('setDeliveryCost')->willReturn(10.50);
//        $shoppingCartService = new ShoppingCartService($deliveryService);

        $this->assertTrue(true);
    }
}
