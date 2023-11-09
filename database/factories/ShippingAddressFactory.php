<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingAddress>
 */
class ShippingAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'user_id' => \App\Models\User::factory(),
            'recipient_name' => $this->faker->name,
            'address' => $this->faker->address,
            'sub_district_id' => \App\Models\SubDistrict::factory(),
            'district_id' => \App\Models\District::factory(),
            'city_id' => \App\Models\City::factory(),
            'province_id' => \App\Models\Province::factory(),
            'postal_code' => $this->faker->postcode,
            'phone_number' => $this->faker->phoneNumber,
            'landmark' => $this->faker->optional()->paragraph,
        ];
    }
}
