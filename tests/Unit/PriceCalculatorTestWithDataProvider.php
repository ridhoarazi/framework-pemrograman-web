<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\PriceCalculator;

/**
 * Demonstrasi @dataProvider — satu test method, banyak test case
 */
class PriceCalculatorTestWithDataProvider extends TestCase
{
    /**
     * Data provider: array of [price, discount, expected]
     */
    public static function discountData(): array
    {
        return [
            'diskon 10% dari 100'   => [100, 10, 90],
            'diskon 0% dari 500'    => [500, 0, 500],
            'diskon 100% dari 200'  => [200, 100, 0],
            'diskon 25% dari 1000'  => [1000, 25, 750],
            'diskon 50% dari 80'    => [80, 50, 40],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('discountData')]
    public function test_applies_various_discounts(float $price, float $discount, float $expected): void
    {
        $calc = new PriceCalculator();
        $result = $calc->applyDiscount($price, $discount);

        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider: test exception cases
     */
    public static function invalidDiscountData(): array
    {
        return [
            'diskon negatif -5'   => [-5],
            'diskon > 100 (110)'  => [110],
            'diskon > 100 (200)'  => [200],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('invalidDiscountData')]
    public function test_throws_exception_for_invalid_discount(float $invalidDiscount): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $calc = new PriceCalculator();
        $calc->applyDiscount(100, $invalidDiscount);
    }
}
