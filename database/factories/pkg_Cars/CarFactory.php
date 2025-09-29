<?php

namespace Database\Factories\pkg_Cars;

use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\pkg_Agencies\Agency;
use App\Models\pkg_Cars\Car;
use App\Models\pkg_Parameters\CarBrand;
use App\Models\pkg_Parameters\CarModel;
use App\Models\pkg_Parameters\CarCategory;
use App\Models\pkg_Parameters\CarColor;
use App\Models\pkg_Parameters\CarFuelType;
use App\Models\pkg_Parameters\CarCity;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pkg_Cars\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => $this->faker->year(),
            'mileage' => $this->faker->numberBetween(0, 100000),
            'transmission' => $this->faker->randomElement(['Manual', 'Automatic']),
            'registration_number' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'is_available' => $this->faker->boolean(),
            'description' => $this->faker->sentence(),
            'features' => $this->faker->words(3, true),
            // 'agency_id' => Agency::factory(), // Uncomment and fix
            'brand_id' => CarBrand::factory(),
            'model_id' => CarModel::factory(),
            'category_id' => CarCategory::factory(),
            'color_id' => CarColor::factory(),
            'fuel_type_id' => CarFuelType::factory(),
            'city_id' => CarCity::factory(),
        ];
    }
}
