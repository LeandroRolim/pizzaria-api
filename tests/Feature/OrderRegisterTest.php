<?php


use App\Models\Order\Address;
use App\Models\Order\Order;
use Laravel\Lumen\Testing\DatabaseMigrations;

class OrderRegisterTest extends TestCase
{
    use DatabaseMigrations;

    public function testRegisterOrder()
    {
        $address = factory(Address::class)->create();
        $order = factory(Order::class)->make([
            'order_address_id' => $address->id,
        ]);
        $product_id = mt_rand(1, 100);
        $product_amount = mt_rand(1, 5);
        $this
            ->post('order', [
                'products' => [
                    [
                        'product_id' => $product_id,
                        'amount' => $product_amount,
                    ],
                    [
                        'product_id' => $product_id * 2,
                        'amount' => $product_amount * 2,
                    ],
                ],
                'user_uid' => $order->user_uid,
                'order_address_id' => $address->id,
                'comments' => $order->comments,
            ])
            ->assertResponseStatus(201);

        $this->seeInDatabase('orders', [
            'user_uid' => $order->user_uid,
            'comments' => $order->comments,
            'order_address_id' => $address->id,
        ]);
        $this->seeInDatabase('order_products', [
            'product_id' => $product_id,
            'amount' => $product_amount,
        ]);
        $this->seeInDatabase('order_products', [
            'product_id' => $product_id * 2,
            'amount' => $product_amount * 2,
        ]);
    }

    public function testRegisterOrderWithoutProducts()
    {
        $address = factory(Address::class)->create();
        $this
            ->post('order', [
                'products' => [
                ],
                'user_uid' => 1,
                'order_address_id' => $address->id,
                'comments' => '',
            ])
            ->assertResponseStatus(422);

        $this->notSeeInDatabase('orders', [
            'user_uid' => 1,
            'comments' => '',
            'order_address_id' => $address->id,
        ]);
    }
}
