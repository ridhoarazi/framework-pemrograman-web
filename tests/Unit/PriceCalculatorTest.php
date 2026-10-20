<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\PriceCalculator;

class PriceCalculatorTest extends TestCase
{
    /**
     * Demo #1: Basic Unit Test — PASS case
     */
    public function test_applies_discount(): void
    {
        $calc = new PriceCalculator();
        $result = $calc->applyDiscount(100, 10);

        $this->assertEquals(90, $result);
    }

    public function test_returns_same_price_when_no_discount(): void
    {
        $calc = new PriceCalculator();

        $this->assertEquals(500, $calc->applyDiscount(500, 0));
    }

    public function test_applies_full_discount(): void
    {
        $calc = new PriceCalculator();

        $this->assertEquals(0, $calc->applyDiscount(200, 100));
    }

    /**
     * Demo #2: Exception Testing
     */
    public function test_invalid_percent_throws_exception(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $calc = new PriceCalculator();
        $calc->applyDiscount(100, 110);
    }

    public function test_adds_tax(): void
    {
        $calc = new PriceCalculator();

        $this->assertEquals(110, $calc->addTax(100, 10));
    }
}
