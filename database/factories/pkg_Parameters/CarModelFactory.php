<?php

namespace Database\Factories\pkg_Parameters;

use App\Models\pkg_Parameters\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\\Models\\pkg_Parameters\\CarModel>
 */
class CarModelFactory extends Factory
{
    protected $model = CarModel::class;

    public function definition(): array
    {
        return [
            'brand_name' => $this->faker->company(), // Match the column name in the database
        ];
    }
}
