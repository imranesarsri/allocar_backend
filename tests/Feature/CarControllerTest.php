<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\pkg_Cars\Car;
// use App\Models\pkg_Parameters\CarAgency;
use App\Models\pkg_Parameters\CarBrand;
use App\Models\pkg_Parameters\CarModel;
use App\Models\pkg_Parameters\CarCategory;
use App\Models\pkg_Parameters\CarColor;
use App\Models\pkg_Parameters\CarFuelType;
use App\Models\pkg_Parameters\CarCity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $carRepository;

    public function setUp(): void
    {
        parent::setUp();
        // Mocking the CarRepository can be done here if needed, but we'll test with real repo
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testIndexReturnsAllCars()
    {
        Car::factory()->count(3)->create();

        $response = $this->getJson('/pkg_cars/cars');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'cars' => [
                         '*' => [
                             'id',
                             'year',
                             'registration_number',
                             'agency',
                             'brand',
                             'model',
                             'category',
                             'color',
                             'fuel_type',
                             'city'
                         ]
                     ]
                 ])
                 ->assertJson(['success' => true])
                 ->assertJsonCount(3, 'cars');
    }

    public function testStoreCreatesCarSuccessfully()
    {
        $data = [
            'year' => 2020,
            'mileage' => 15000,
            'transmission' => 'Automatic',
            'registration_number' => 'XYZ123',
            'price' => 25000.00,
            'is_available' => true,
            'description' => 'A nice car',
            'features' => 'GPS, Bluetooth',
            // 'agency_id' => CarAgency::factory()->create()->id,
            'brand_id' => CarBrand::factory()->create()->id,
            'model_id' => CarModel::factory()->create()->id,
            'category_id' => CarCategory::factory()->create()->id,
            'color_id' => CarColor::factory()->create()->id,
            'fuel_type_id' => CarFuelType::factory()->create()->id,
            'city_id' => CarCity::factory()->create()->id,
        ];

        $response = $this->postJson('/pkg_cars/cars', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'car' => [
                         'registration_number' => 'XYZ123',
                         'year' => 2020,
                     ]
                 ])
                 ->assertJsonStructure([
                     'success',
                     'car' => [
                         'id',
                         'year',
                         'registration_number',
                         'agency',
                         'brand',
                         'model',
                         'category',
                         'color',
                         'fuel_type',
                         'city'
                     ]
                 ]);

        $this->assertDatabaseHas('pkg_cars_cars', ['registration_number' => 'XYZ123']);
    }

    public function testStoreFailsWithInvalidData()
    {
        $data = [
            'year' => 'invalid', // Should be integer
            'mileage' => -1,     // Should be non-negative
        ];

        $response = $this->postJson('/pkg_cars/cars', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['year', 'mileage']);
    }

    public function testShowReturnsCarById()
    {
        $car = Car::factory()->create();

        $response = $this->getJson("/pkg_cars/cars/{$car->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'car' => [
                         'id' => $car->id,
                         'registration_number' => $car->registration_number,
                     ]
                 ])
                 ->assertJsonStructure([
                     'success',
                     'car' => [
                         'id',
                         'year',
                         'registration_number',
                         'agency',
                         'brand',
                         'model',
                         'category',
                         'color',
                         'fuel_type',
                         'city'
                     ]
                 ]);
    }

    public function testShowReturns404ForNonExistentCar()
    {
        $response = $this->getJson('/pkg_cars/cars/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Car not found'
                 ]);
    }

    public function testUpdateModifiesCarSuccessfully()
    {
        $car = Car::factory()->create(['price' => 20000.00]);
        $data = [
            'price' => 30000.00,
            'year' => 2021,
            'mileage' => 20000,
            'transmission' => 'Manual',
            'registration_number' => $car->registration_number, // Same to avoid unique conflict
            'is_available' => false,
            'description' => 'Updated car',
            'features' => 'GPS, AC',
            // 'agency_id' => CarAgency::factory()->create()->id,
            'brand_id' => CarBrand::factory()->create()->id,
            'model_id' => CarModel::factory()->create()->id,
            'category_id' => CarCategory::factory()->create()->id,
            'color_id' => CarColor::factory()->create()->id,
            'fuel_type_id' => CarFuelType::factory()->create()->id,
            'city_id' => CarCity::factory()->create()->id,
        ];

        $response = $this->putJson("/pkg_cars/cars/{$car->id}", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'car' => [
                         'id' => $car->id,
                         'price' => 30000.00,
                     ]
                 ])
                 ->assertJsonStructure([
                     'success',
                     'car' => [
                         'id',
                         'year',
                         'registration_number',
                         'agency',
                         'brand',
                         'model',
                         'category',
                         'color',
                         'fuel_type',
                         'city'
                     ]
                 ]);

        $this->assertDatabaseHas('pkg_cars_cars', ['id' => $car->id, 'price' => 30000.00]);
    }

    public function testUpdateFailsWithInvalidData()
    {
        $car = Car::factory()->create();

        $data = [
            'year' => 'invalid', // Should be integer
            'mileage' => -1,     // Should be non-negative
        ];

        $response = $this->putJson("/pkg_cars/cars/{$car->id}", $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['year', 'mileage']);
    }

    public function testUpdateReturns404ForNonExistentCar()
    {
        $data = [
            'year' => 2020,
            'mileage' => 15000,
            'transmission' => 'Automatic',
            'registration_number' => 'ABC123',
            'price' => 25000.00,
            'is_available' => true,
            // 'agency_id' => CarAgency::factory()->create()->id,
            'brand_id' => CarBrand::factory()->create()->id,
            'model_id' => CarModel::factory()->create()->id,
            'category_id' => CarCategory::factory()->create()->id,
            'color_id' => CarColor::factory()->create()->id,
            'fuel_type_id' => CarFuelType::factory()->create()->id,
            'city_id' => CarCity::factory()->create()->id,
        ];

        $response = $this->putJson('/pkg_cars/cars/999', $data);

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Car not found'
                 ]);
    }
}
