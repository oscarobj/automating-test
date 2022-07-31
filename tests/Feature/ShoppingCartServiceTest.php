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
     * Test the shopping cart products add
     */
    public function addProductInCart()
    {
        //Arrange
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

        // Act
        $updatedShoppingCart = $shoppingCartService->addProductQuantity($shoppingCart, $shirt, $quantity);
        $updatedShoppingCart = $shoppingCartService->addProductQuantity($updatedShoppingCart, $shoe, $quantity);

        // Assert
        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     * Test the shopping cart products remove
     */
    public function removeProductInCart()
    {
        //Arrange
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

        // Act
        $updatedShoppingCart = $shoppingCartService->removeProductQuantity($shoppingCart, $shoe, 1);

        // Assert
        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     * remover quantity greater than cart (ex.: car have 2 shirts, and try remove 3 shirts. The final quantity should retur zero)
     */
    public function removeQuantityGreaterThanCart()
    {
        // Arrange
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

        // Act
        $updatedShoppingCart = $shoppingCartService->removeProductQuantity($shoppingCart, $shoe, $quantityToRemove);

        // Assert
        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     */
    public function emptyCartNeedsToReturnAnEmptyArray()
    {
        // Arrange
        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $shoppingCartService = new ShoppingCartService($deliveryService);
        $shoppingCart = $this->setEmptyShoppingCart();

        $shoppingCart->products = [
            0 => ['id' => 1, 'quantity' => 2, 'price' => 10],
        ];

        $expected = [];

        // Act
        $updatedShoppingCart = $shoppingCartService->emptyCart($shoppingCart);

        // Assert
        $this->assertEquals($expected, $updatedShoppingCart->products);
    }

    /**
     * @test
     */
    public function returnShoppingCartFinalValue()
    {
        //Arrange

        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $deliveryService->shouldReceive('setDeliveryCost')->with('87020-030')->andReturn(10.50);
        $shoppingCartService = new ShoppingCartService($deliveryService);

        $shoppingCart = $this->setEmptyShoppingCart();

        $shoppingCart->products = [
            0 => ['id' => 1, 'quantity' => 0, 'price' => 10],
            1 => ['id' => 2, 'quantity' => 0, 'price' => 15],
        ];

        $userAddress = '87020-030';
        $expected = 0;
        //Act
        $totalPrice = $shoppingCartService->recalculateShoppingCart($shoppingCart, $userAddress);

        //Assert
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @test
     */
    public function recalculateEmptyCartMustReturnZero()
    {
        //Arrange

        $deliveryService = Mockery::mock(DeliveryInterface::class);
        $deliveryService->shouldReceive('setDeliveryCost')->with('87020-030')->andReturn(10.50);
        $shoppingCartService = new ShoppingCartService($deliveryService);

        $shoppingCart = $this->setEmptyShoppingCart();

        // Act
        $finalValue = $shoppingCartService->recalculateShoppingCart($shoppingCart, '87020-030');

        // Assert
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
