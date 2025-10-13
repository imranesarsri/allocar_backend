<?php

namespace App\Repositories\pkg_Cars;

use App\Models\pkg_Cars\Car;
use App\Models\pkg_Parameters\CarBrand;
use App\Models\pkg_Parameters\CarCity;
use App\Models\pkg_Parameters\CarModel;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CarRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Car());
    }


    /**
     * Retrieve all cars
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCars()
    {
        Log::info('Retrieving all cars');
        try {
            //Retive all cars
            $cars = Car::with([
                'agency',
                'brand',
                'model',
                'category',
                'color',
                'fuelType',
                'city',
                'reviews',
                'images'
            ])->where('is_available', 1)
                ->get();

            $carsWithPromotions = $cars->map(function ($car) {
                return $this->addPromotionInfo($car);
            });

            Log::info('Retrieved all cars', ['count' => $cars->count()]);

            return response()->json(['success' => true, 'cars' => $carsWithPromotions], 200);
        } catch (Exception $exception) {
            // Log the error
            Log::error('Error retrieving all cars', ['error' => $exception->getMessage()]);

            return response()->json(['field' => false, 'message' => 'An unexpected error occurred while fetching cars.'], 500);
        }
    }

    public function getCarsWithActivePromotions()
    {
        Log::info('Retrieving cars with active promotions');

        try {
            $cars = Car::with(['brand', 'model', 'images'])
                ->onDiscount()
                ->get();

            $carsWithPromotions = $cars->map(function ($car) {
                // Ensure promotion is returned as array
                $promotion = $this->addPromotionInfo($car)['promotion'];

                return [
                    'car_id' => $car->car_id,
                    'year' => $car->year,
                    'brand' => $car->brand->toArray(),
                    'model' => $car->model->toArray(),
                    'images' => $car->images->toArray(),
                    'promotion' => $promotion,
                ];
            });

            return response()->json(['success' => true, 'cars' => $carsWithPromotions], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving cars with promotions', ['error' => $exception->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error fetching promotional cars.'], 500);
        }
    }


    public function getFeaturedCars()
    {
        $featuredCars = Car::with(['model', 'brand', 'category', 'images'])
            ->where('feature_car', 1)
            ->get();

        $featuredCars->each(function ($car) {
            $car->image_count = $car->images->count();
        });

        return response()->json([
            'success' => true,
            'cars' => $featuredCars
        ], 200);
    }


    public function getTopCities()
    {
        // Step 1: Get top 8 cities with most cars
        $topCityStats = Car::select('car_city_id', DB::raw('COUNT(*) as cars_count'))
            ->groupBy('car_city_id')
            ->orderByDesc('cars_count')
            ->limit(8)
            ->get();

        // Step 2: Get city names
        $cityIds = $topCityStats->pluck('car_city_id');
        $cities = CarCity::whereIn('car_city_id', $cityIds)->get()->keyBy('car_city_id');

        $result = [];

        foreach ($topCityStats as $stat) {
            $cars = Car::where('car_city_id', $stat->car_city_id)
                ->select('car_id', 'year', 'price', 'car_model_id', 'car_brand_id') // minimal fields
                ->with(['model', 'brand', 'images']) // eager load relations
                ->limit(8)
                ->get()
                ->map(function ($car) {
                    return [
                        'car_id' => $car->car_id,
                        'year' => $car->year,
                        'price' => $car->price,
                        'model' => $car->model, // already eager-loaded
                        'brand' => $car->brand,
                        'images' => $car->images
                    ];
                });

            $result[] = [
                'city_id' => $stat->car_city_id,
                'city_name' => $cities[$stat->car_city_id]->city_name ?? 'Unknown',
                'cars_count' => $stat->cars_count,
                'cars' => $cars
            ];
        }

        return response()->json([
            'success' => true,
            'top_cities' => $result
        ], 200);
    }




    public function searchByValues(array $filters)
    {
        $query = Car::query()->with(['color', 'brand', 'city', 'category', 'model', 'fuelType']);

        if (!empty($filters['colors'])) {
            $query->whereHas('color', function ($q) use ($filters) {
                $q->whereIn('color_name', $filters['colors']);
            });
        }

        if (!empty($filters['brands'])) {
            $query->whereHas('brand', function ($q) use ($filters) {
                $q->whereIn('brand_name', $filters['brands']);
            });
        }
        if (!empty($filters['cities'])) {
            $query->whereHas('city', function ($q) use ($filters) {
                $q->whereIn('city_name', $filters['cities']);
            });
        }

        if (!empty($filters['categories'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->whereIn('category_name', $filters['categories']);
            });
        }

        if (!empty($filters['models'])) {
            $query->whereHas('model', function ($q) use ($filters) {
                $q->whereIn('model_name', $filters['models']);
            });
        }
        if (!empty($filters['fuel_types'])) {
            $query->whereHas('fuelType', function ($q) use ($filters) {
                $q->whereIn('fuel_type_name', $filters['fuel_types']);
            });
        }


        return $query->get();
    }

    public function filterByAttributesGrouped(
        ?string $brandName,
        ?string $colorName,
        ?string $cityName,
        ?string $modelName,
        ?string $fuelTypeName,
        ?string $categoryName,
        ?bool $onPromotion = null
    ) {
                $query = Car::with(['brand', 'model', 'color', 'city', 'category', 'fuelType', 'images'])
            ->where('is_available', 1);

        if ($brandName) {
            $query->whereHas('brand', function ($q) use ($brandName) {
                $q->where('brand_name', $brandName);
            });
        }

        if ($colorName) {
            $query->whereHas('color', function ($q) use ($colorName) {
                $q->where('color_name', $colorName);
            });
        }

        if ($cityName) {
            $query->whereHas('city', function ($q) use ($cityName) {
                $q->where('city_name', $cityName);
            });
        }

        if ($modelName) {
            $query->whereHas('model', function ($q) use ($modelName) {
                $q->where('model_name', $modelName);
            });
        }

        if ($fuelTypeName) {
            $query->whereHas('fuelType', function ($q) use ($fuelTypeName) {
                $q->where('fuel_type_name', $fuelTypeName);
            });
        }

        if ($categoryName) {
            $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('category_name', $categoryName);
            });
        }

        if ($onPromotion === true) {
            $query->onDiscount();
        }

        $cars = $query->get();

        if ($cars->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Pas de résultat pour cette recherche'
            ], 404);
        }

        $brands = collect();
        $models = collect();
        $colors = collect();
        $cities = collect();
        $fuelTypes = collect();
        $categories = collect();

        $carsData = $cars->map(function ($car) use (&$brands, &$models, &$colors, &$cities, &$fuelTypes, &$categories) {
            $brands[$car->brand->car_brand_id] = $car->brand;
            $models[$car->model->car_model_id] = $car->model;
            $colors[$car->color->car_color_id] = $car->color;
            $cities[$car->city->car_city_id] = $car->city;
            $fuelTypes[$car->fuelType->car_fuel_type_id] = $car->fuelType;
            $categories[$car->category->car_category_id] = $car->category;

            $carData = [
                'car_id' => $car->car_id,
                'price' => $car->price,
                'year' => $car->year,
                'mileage' => $car->mileage,
                'transmission' => $car->transmission,
                'number_of_seats' => $car->number_of_seats,
                'color_id' => $car->color->car_color_id,
                'brand_id' => $car->brand->car_brand_id,
                'city_id' => $car->city->car_city_id,
                'category_id' => $car->category->car_category_id,
                'model_id' => $car->model->car_model_id,
                'fuel_type_id' => $car->fuelType->car_fuel_type_id,
                'images' => $car->images,
            ];

            return array_merge($carData, $this->getPromotionData($car));
        });

        return [
            'success' => true,
            'data' => [
                'cars' => $carsData,
                'brands' => array_values($brands->toArray()),
                'models' => array_values($models->toArray()),
                'colors' => array_values($colors->toArray()),
                'cities' => array_values($cities->toArray()),
                'fuel_types' => array_values($fuelTypes->toArray()),
                'categories' => array_values($categories->toArray()),
            ]
        ];
    }



    /**
     * Retrieve paginated cars
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedCars()
    {
        Log::info('Retrieving all cars with pagination ');
        try {
            Log::info('Retrieving all cars with pagination');
            $query = Car::with([
                'agency',
                'brand',
                'model',
                'category',
                'color',
                'fuelType',
                'city',
                'reviews',
                'images'
            ]);
            // ->where('is_discount', 1)

            $cars = $query->paginate($this->paginationLimit);
            Log::info('Retrieved ' . $cars->total() . ' cars');
            return response()->json(['success' => true, 'data' => $cars], 200);
        } catch (Exception $exception) {
            Log::error('Error details: ', ['error' => $exception]);
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Retrieve Total count of cars
     * @return \Illuminate\Http\JsonResponse
     */

    // Removed duplicate getCountCars method to resolve redeclaration error.

    /**
     * Find and retrieve a car by ID
     * @param int $carId
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCarById($carId)
    {
        Log::info('find car with id' . $carId);
        try {
            $car = Car::with([
                'agency',
                'brand',
                'model',
                'category',
                'color',
                'fuelType',
                'city',
                'reviews',
                'images'
            ])->find($carId);
            if ($car) {
                return response()->json(['success' => true, 'data' => $car], 200);
            } else {
                return response()->json(['field' => false, 'message' => 'Internal Server Error'], 500);
            }
        } catch (Exception $exception) {
            Log::error('Error finding car with ID: ' . $carId . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Car not found'], 404);
        }
    }


    /**
     * Create a new car
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCar(array $data)
    {
        DB::beginTransaction();

        try {
            // Default promotion values
            $data = array_merge([
                'is_discount' => 0,
                'discount_price' => null,
                'discount_end_date' => null
            ], $data);

            // Create the car
            $car = $this->create($data);

            // Handle image upload
            if (request()->hasFile('images')) {
                foreach (request()->file('images') as $index => $image) {
                    $path = $image->store('car_images', 'public');

                    $car->images()->create([
                        'image_url' => $path,
                        'is_primary' => $index === 0, // Mark first image as primary
                    ]);
                }
            }

            $car->load(['agency', 'category', 'brand', 'model', 'city', 'color', 'fuelType', 'images']);

            DB::commit();

            return response()->json(['success' => true, 'data' => $car], 201);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Error creating car: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Update an existing car by its ID
     * @param int $carId
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateCar(array $data, $carId)
    {
        try {
            Log::info('Updating car with ID: ' . $carId, ['data' => $data]);

               $car = $this->find($carId);

            // Perform the update
            $result = $this->update($carId, $data);
            Log::info('Update result: ' . ($result ? 'success' : 'failure'));

            if ($result) {
                // Load relationships
                $car->load(['category', 'brand', 'model', 'city', 'color', 'fuelType']);
                return response()->json(['success' => true, 'car' => $car], 200);
            }

            return response()->json(['success' => false, 'message' => 'Failed to update car'], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error updating car with ID: ' . $carId . ' - ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Database error', 'error' => $e->getMessage()], 500);
        } catch (Exception $exception) {
            return response()->json(['success' => false, $exception->getMessage()], 404);
        }
    }

    /**
     * Delete a car by its ID
     * @param int $carId
     * @return \Illuminate\Http\JsonResponse
     */
    // filepath: c:\Users\hp\app\backEnd\app\Repositories\pkg_Cars\CarRepository.php
    public function deleteCar($id)
    {
        try {
            $deleted = $this->destroy($id);
            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Car deleted successfully'], 200);
            }

            return response()->json(['success' => false, 'message' => 'Failed to delete car'], 500);
        } catch (Exception $exception) {
            // Log the error
            return response()->json(['success' => false, $exception->getMessage()], 500);
        }
    }



    public function getAllBrands()
    {
        return CarBrand::select('car_brand_id', 'brand_name')
            ->withCount('cars')
            ->get();
    }

    public function getModelsBrand($brand_id)
    {
        return CarModel::where('car_brand_id', $brand_id)
            ->select('car_model_id as id', 'model_name')
            ->get();

    }

    public function getYearsByModel($model_id)
    {
        return Car::where('car_model_id', $model_id)
            ->distinct()
            ->pluck('year');
    }





    //promotion
    private function addPromotionInfo($car)
    {
        $carArray = $car->toArray();

        return array_merge($carArray, $this->getPromotionData($car));
    }

    /**
     * Get promotion data for a car
     */
    private function getPromotionData($car)
    {
        $isPromotionActive = $car->is_discount && $car->discount_end_date && Carbon::parse($car->discount_end_date)->gte(now());

        return [
            'promotion' => [
                'is_on_promotion' => $isPromotionActive,
                'original_price' => $car->price,
                'current_price' => $isPromotionActive ? $car->discount_price : $car->price,
                'discount_price' => $car->discount_price,
                'discount_end_date' => $car->discount_end_date,
                'discount_percentage' => $isPromotionActive && $car->discount_price ?
                    round((($car->price - $car->discount_price) / $car->price) * 100, 2) : 0,
                'savings' => $isPromotionActive && $car->discount_price ?
                    round($car->price - $car->discount_price, 2) : 0,
                'days_remaining' => $isPromotionActive ?
                    Carbon::parse($car->discount_end_date)->diffInDays(now()) : 0
            ]
        ];
    }

    /**
     * Validate promotion data
     */
    private function validatePromotionData(array $data)
    {
        // If discount is enabled, ensure required fields are present
        if (isset($data['is_discount']) && $data['is_discount']) {
            if (!isset($data['discount_price']) || !isset($data['discount_end_date'])) {
                throw new Exception('Discount price and end date are required when discount is enabled.');
            }

            if ($data['discount_price'] >= $data['price']) {
                throw new Exception('Discount price must be less than the original price.');
            }

            if (Carbon::parse($data['discount_end_date'])->lt(now())) {
                throw new Exception('Discount end date must be in the future.');
            }
        } else {
            // If discount is disabled, clear discount fields
            $data['is_discount'] = false;
            $data['discount_price'] = null;
            $data['discount_end_date'] = null;
        }

        return $data;
    }


    /**
     * Retrieve the 10 latest added cars
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestCars()
    {
        Log::info('Retrieving latest 10 cars');
        try {
            $cars = Car::with([
                'agency',
                'brand',
                'model',
                'category',
                'color',
                'fuelType',
                'city',
                'reviews',
                'images'
            ])
                ->where('is_available', 1) // Seulement les voitures disponibles
                ->orderBy('created_at', 'desc') // Trier par date de création décroissante
                ->limit(10) // Limiter à 10 résultats
                ->get();

            // Ajouter les informations de promotion
            $carsWithPromotions = $cars->map(function ($car) {
                return $this->addPromotionInfo($car);
            });

            Log::info('Retrieved latest cars', ['count' => $cars->count()]);

            return response()->json([
                'success' => true,
                'data' => $carsWithPromotions,
                'message' => 'Latest cars retrieved successfully'
            ], 200);

        } catch (Exception $exception) {
            Log::error('Error retrieving latest cars', ['error' => $exception->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred while fetching latest cars.'
            ], 500);
        }
    }


    public function getTop8Models()
    {
        return Car::with(['model', 'brand'])
            ->select('car_model_id', 'car_brand_id', DB::raw('count(*) as car_count'))
            ->whereNotNull('car_model_id')
            ->groupBy('car_model_id', 'car_brand_id')
            ->orderBy('car_count', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->model->car_model_id,
                    'name' => $car->model->model_name,
                    'brand_name' => $car->brand->brand_name,
                    'logo_url' => $car->brand->logo_url,
                    'count' => $car->car_count
                ];
            });
    }
    public function getTop8Brands()
    {
        return Car::with('brand')
            ->select('car_brand_id', DB::raw('count(*) as car_count'))
            ->whereNotNull('car_brand_id')
            ->groupBy('car_brand_id')
            ->orderBy('car_count', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->brand->car_brand_id,
                    'name' => $car->brand->brand_name,
                    'logo_url' => $car->brand->logo_url,
                    'count' => $car->car_count
                ];
            });
    }

    public function getTop8Cities()
    {
        return Car::with('city')
            ->select('car_city_id', DB::raw('count(*) as car_count'))
            ->whereNotNull('car_city_id')
            ->groupBy('car_city_id')
            ->orderBy('car_count', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->city->car_city_id,
                    'name' => $car->city->city_name,
                    'count' => $car->car_count
                ];
            });
    }

    public function getAllCitiesWithCars()
    {
        return CarCity::select('car_city_id', 'city_name', 'country')
            ->withCount('cars')
            ->with([
                'cars' => function ($query) {
                    $query->select('car_id', 'price', 'car_brand_id', 'car_city_id', 'is_available')
                        ->with(['brand:car_brand_id,brand_name,logo_url'])
                        ->where('is_available', 1);
                }
            ])
            ->having('cars_count', '>', 0)
            ->orderBy('cars_count', 'desc')
            ->get();
    }

    public function getCountCars()
    {
        return CarCity::withCount('cars')->get()->sum('cars_count');
    }
    public function getCount()
    {
        return Car::count();
    }

    /**
     * Get the count of cars with active discounts
     *
     * @return int
     */
    public function getDiscountCount()
    {
        return DB::table('cars')
            ->where('is_discount', 1)
            ->where('discount_end_date', '>=', now()->toDateString())
            ->where('is_available', 1)
            ->count();
    }
    public function getCarsByAgency($agencyId)
{
    try {
        $cars = Car::with([
            'agency',
            'brand',
            'model',
            'category',
            'color',
            'fuelType',
            'city',
            'reviews',
            'images'
        ])
        ->where('is_available', 1)
        ->where('agency_id', $agencyId)
        ->get();

        $carsWithPromotions = $cars->map(function ($car) {
            return $this->addPromotionInfo($car);
        });

        return response()->json(['success' => true, 'cars' => $carsWithPromotions], 200);
    } catch (Exception $exception) {
        Log::error('Error retrieving cars for agency', ['error' => $exception->getMessage()]);
        return response()->json(['success' => false, 'message' => 'An unexpected error occurred while fetching cars.'], 500);
    }
}
}
