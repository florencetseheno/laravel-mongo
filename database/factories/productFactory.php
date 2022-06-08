<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(30),
            'description'=>$this->faker->text(),
            'image'=>$this->faker->imageUrl(),
            'price'=>$this->faker->numberBetween(10,100)
        ];
    }
}
