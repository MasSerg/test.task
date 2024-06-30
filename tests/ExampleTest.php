<?php

namespace Test;

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function test_example()
    {
        $this->assertSame('John', 'aaaaa');
    }

    public function test_example_2()
    {
        $this->assertSame('John', 'John');
    }

}