<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function it_can_create_an_category()
    {
       $category  = Category:: make([
        'id' => '28',
        'name' => 'Sports'

       ]);
       $this->assertTrue('29', $category->id);

    }
}
