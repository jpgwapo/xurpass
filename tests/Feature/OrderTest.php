<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testOrder()
    {
        $userData = [
            "product_id" => "1",
            "quantity" => "2",
        ];

        $this->json('POST', 'api/order', $userData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Failed to order this product due to unavailability of the stock',
            ]);
    }
}
