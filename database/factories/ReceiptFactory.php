<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ReceiptDetails;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receipt>
 */
class ReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sum_total =  ReceiptDetails::factory(5)->create()->sum('total');

        $discount = $this->faker->numberBetween(5, 20);
        $amount_paid = $sum_total- 1000 ;

        return [
            'user_id' => User::first()->id,
            'customer_id' => Customer::first()->id,
            'serial_no' => $this->faker->ean13,
            'issue_date' => now()->subDays(7)->format('Y-m-d'),
            'payment_date' => now()->format('Y-m-d'),
            'sum_total' => $sum_total,
            'discount' => $discount,
            'sub_total' => round($sum_total * ((100 - $discount) / 100), 2),
            'amount_paid' => $amount_paid,
            'amount_owing' => 1000,
            'payment_method' => $this->faker->randomElement(['Cash', 'Card', 'Transfer'])
        ];
    }
}