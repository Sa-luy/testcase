<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
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
    public function it_can_create_an_category()
    {
        $data = [
          'name' => $this->faker->name,
        ];
      
        $this->post(route('categories.store'), $data)
          ->assertStatus(201)
          ->assertJson($data);
    }
}
