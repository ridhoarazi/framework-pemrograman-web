<?php

namespace App\Services;

class PriceCalculator
{
    /**
     * Hitung harga setelah diskon.
     *
     * @throws \InvalidArgumentException jika persen < 0 atau > 100
     */
    public function applyDiscount(float $price, float $percent): float
    {
        if ($percent < 0 || $percent > 100) {
            throw new \InvalidArgumentException('Diskon harus 0-100');
        }

        return $price - ($price * $percent / 100);
    }

    /**
     * Tambah pajak ke harga.
     */
    public function addTax(float $price, float $taxPercent): float
    {
        return $price + ($price * $taxPercent / 100);
    }
}
