<?php

namespace Database\Factories;

use App\Models\phonebooks;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PhonebooksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = phonebooks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = (new \Faker\Factory())::create();
        return [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobileNumber' => $this->faker->unique()->regexify('09[0-9]{9}'),
            'phoneNumber' => $this->faker->phoneNumber(),
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
