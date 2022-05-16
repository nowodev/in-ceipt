<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceDetails>
 */
class InvoiceDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $unit_price = $this->faker->numberBetween(100, 9000);
        $quantity = $this->faker->numberBetween(1, 19);
        $invoice = Invoice::latest()->first()?->id;

        return [
            'invoice_id' => !is_null($invoice) ? $invoice : $invoice + 1, // get latest id, then increment
            'description' => $this->faker->sentence(),
            'unit_price' => $unit_price,
            'quantity' => $quantity,
            'total' => $unit_price * $quantity,
        ];
    }
}