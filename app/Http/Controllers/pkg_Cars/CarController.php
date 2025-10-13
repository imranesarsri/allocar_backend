<?php

namespace App\Http\Controllers\pkg_Cars;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Cars\CarRequest;
use App\Models\pkg_Cars\Car;
use App\Models\pkg_Parameters\CarCity;
use App\Repositories\pkg_Agencies\AgencyRepository;
use App\Repositories\pkg_Parameters\CarBrandRepository;
use App\Repositories\pkg_Parameters\CarCityRepository;
use App\Repositories\pkg_Parameters\CarColorRepository;
use App\Repositories\pkg_Parameters\CarFuelTypeRepository;
use App\Repositories\pkg_Parameters\CarModelRepository;
use App\Repositories\Pkg_Cars\CarRepository;
use App\Repositories\pkg_Parameters\CarCategoryRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CarController extends Controller
{
    protected $carRepository;
    protected $carCategoryRepository;
    protected $carBrandRepository;
    protected $carModelRepository;
    protected $carCityRepository;
    protected $carColorRepository;
    protected $carFuelTypeRepository;
    protected $agencyRepository;


    public function __construct(
        CarRepository $carRepository,
        CarCategoryRepository $carCategoryRepository,
        CarBrandRepository $carBrandRepository,
        CarModelRepository $carModelRepository,
        CarCityRepository $carCityRepository,
        CarColorRepository $carColorRepository,
        CarFuelTypeRepository $carFuelTypeRepository,
        AgencyRepository $agencyRepository,
    ) {
        $this->carRepository = $carRepository;
        $this->carCategoryRepository = $carCategoryRepository;
        $this->carBrandRepository = $carBrandRepository;
        $this->carModelRepository = $carModelRepository;
        $this->carCityRepository = $carCityRepository;
        $this->carColorRepository = $carColorRepository;
        $this->carFuelTypeRepository = $carFuelTypeRepository;
        $this->agencyRepository = $agencyRepository;
    }
    // get all cars
    public function index(Request $request)
    {
        $user = $request->user(); // or auth()->user();

        if ($user->role === 'super admin') {
            return $this->carRepository->getAllCars();
        } elseif ($user->role === 'agency') {
            return $this->carRepository->getCarsByAgency($user->agency_id);
        } else {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
    }
    public function countCars(){
        $count = $this->carRepository->getCountCars();
        return response()->json([
            'success' => true,
            'data' => $count
        ]);
    }
    public function getPromotionalCars()
    {
        return $this->carRepository->getCarsWithActivePromotions();
    }

    public function featuredCars()
    {
        return $this->carRepository->getFeaturedCars();
    }
    public function topCiteis()
    {
        return $this->carRepository->getTopCities();
    }

    public function paginate(Request $request)
    {
        return $this->carRepository->getPaginatedCars();

        return response()->json([
            'success' => true,
            'data' => $cars
        ], 200);
    }
    // create new car
    public function store(CarRequest $request)
    {
        return $this->carRepository->createCar($request->validated());
    }

    public function search(Request $request)
    {

        $filters = [
            'colors' => $request->query('colors'),
            'brands' => $request->query('brands'),
            'cities' => $request->query('cities'),
            'categories' => $request->query('categories'),
            'models' => $request->query('models'),
            'fuel_types' => $request->query('fuel_types')

        ];

        $cars = $this->carRepository->searchByValues($filters);

        $filteredCars = $cars->map(function ($car) {
            return [
                'car_id' => $car->car_id,
                'color' => $car->color,
                'brand' => $car->brand,
                'city' => $car->city,
                'category' => $car->category,
                'model' => $car->model,
                'fuel_type' => $car->fuelType
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $filteredCars
        ]);


    }
    /**
     * Filtrer les voitures par nom de marque avec données groupées
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function filterByAttributes(Request $request): JsonResponse
    {
        $request->validate([
            'brand_name' => 'nullable|string',
            'color_name' => 'nullable|string',
            'city_name' => 'nullable|string',
            'model_name' => 'nullable|string',
            'fuel_type_name' => 'nullable|string',
            'category_name' => 'nullable|string',
            'on_promotion' => 'nullable|boolean',
        ]);

        $result = $this->carRepository->filterByAttributesGrouped(
            $request->brand_name,
            $request->color_name,
            $request->city_name,
            $request->model_name,
            $request->fuel_type_name,
            $request->category_name,
            $request->on_promotion
        );

        return response()->json($result);
    }


    // get car by id
    public function find()
    {
        return $this->carRepository->findCarById(request('car_id'));
    }
    // update car
    public function update(CarRequest $carRequest)
    {
        return $this->carRepository->updateCar($carRequest->validated(), request('car_id'));
    }
    public function destroy()
    {
        return $this->carRepository->deleteCar(request('car_id'));
    }

    public function togglePromotion(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,car_id',
            'is_discount' => 'required|boolean',
            'discount_price' => 'required_if:is_discount,true|nullable|numeric|min:0',
            'discount_end_date' => 'required_if:is_discount,true|nullable|date|after:today',
        ]);

        $data = [
            'is_discount' => $request->is_discount,
            'discount_price' => $request->discount_price,
            'discount_end_date' => $request->discount_end_date,
        ];

        return $this->carRepository->updateCar($data, $request->car_id);
    }

    /**
     * Get price range for filtering
     */
    public function getPriceRange()
    {
        try {
            $priceRange = DB::select("
                SELECT
                    MIN(CASE
                        WHEN is_discount = 1 AND discount_end_date >= CURDATE()
                        THEN discount_price
                        ELSE price
                    END) as min_price,
                    MAX(CASE
                        WHEN is_discount = 1 AND discount_end_date >= CURDATE()
                        THEN discount_price
                        ELSE price
                    END) as max_price
                FROM cars
                WHERE is_available = 1
            ");

            return response()->json([
                'success' => true,
                'data' => [
                    'min_price' => $priceRange[0]->min_price ?? 0,
                    'max_price' => $priceRange[0]->max_price ?? 0
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching price range'
            ], 500);
        }
    }

    /**
     * Get promotion statistics
     */
    public function getPromotionStats()
    {
        try {
            $stats = DB::select("
                SELECT
                    COUNT(*) as total_cars,
                    SUM(CASE WHEN is_discount = 1 AND discount_end_date >= CURDATE() THEN 1 ELSE 0 END) as cars_on_promotion,
                    AVG(CASE
                        WHEN is_discount = 1 AND discount_end_date >= CURDATE()
                        THEN ((price - discount_price) / price * 100)
                        ELSE 0
                    END) as avg_discount_percentage
                FROM cars
                WHERE is_available = 1
            ");

            return response()->json([
                'success' => true,
                'data' => [
                    'total_cars' => $stats[0]->total_cars,
                    'cars_on_promotion' => $stats[0]->cars_on_promotion,
                    'promotion_percentage' => round(($stats[0]->cars_on_promotion / $stats[0]->total_cars) * 100, 2),
                    'avg_discount_percentage' => round($stats[0]->avg_discount_percentage, 2)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching promotion statistics'
            ], 500);
        }
    }


    public function getBrands()
    {
        $brands = $this->carRepository->getAllBrands();
        return response()->json(['success' => true, 'data' => $brands]);
    }

    public function getAllCitiesWithCars()
    {
        $allCities = $this->carRepository->getAllCitiesWithCars();

        return response()->json([
            'success' => true,
            'total_cities' => $allCities->count(),
            'data' => $allCities
        ]);
    }

    public function getModelsByBrand()
    {
        $models = $this->carRepository->getModelsBrand(request('brand_id'));
        return response()->json(['success' => true, 'data' => $models]);
    }

    /**
     * Get all years available for a given model
     *
     * @param Request $model_id
     * @return JsonResponse
     */
    public function getYearsByModel()
    {
        $years = $this->carRepository->getYearsByModel(request('model_id'));
        return response()->json(['success' => true, 'data' => $years]);
    }

    /**
     * Get the 10 latest added cars
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestCars()
    {
        return $this->carRepository->getLatestCars();
    }

    public function getTop8Cities()
    {
        try {
            $cities = $this->carRepository->getTop8Cities();
            return response()->json([
                'success' => true,
                'data' => $cities
            ]);
        } catch (Exception $exception) {
            Log::error('Error retrieving top 8 cities: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des villes'
            ], 500);
        }
    }
    public function getTop8Models()
    {
        try {
            $models = $this->carRepository->getTop8Models();
            return response()->json([
                'success' => true,
                'data' => $models
            ]);
        } catch (Exception $exception) {
            Log::error('Error retrieving top 8 models: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des modèles'
            ], 500);
        }
    }
    public function getTop8Brands()
    {
        try {
            $brands = $this->carRepository->getTop8Brands();
            return response()->json([
                'success' => true,
                'data' => $brands
            ]);
        } catch (Exception $exception) {
            Log::error('Error retrieving top 8 brands: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des marques'
            ], 500);
        }
    }
    public function getCount()
    {
        try {
            $count = $this->carRepository->getCountCars();
            return response()->json([
                'success' => true,
                'data' => $count
            ]);
        } catch (Exception $exception) {
            Log::error('Error retrieving count: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du comptage'
            ], 500);
        }
    }
    public function getCountCars(){
        try {
            $count = $this->carRepository->getCount();
            return response()->json([
                'success' => true,
                'data' => $count
            ]);
        } catch (Exception $exception) {
            Log::error('Error retrieving count: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du comptage des voitures'
            ], 500);
        }
    }

    public function getDiscountCount()
    {
        try {
            // Call the repository method
            $count = $this->carRepository->getDiscountCount();

            // Return the count in a JSON response
            return response()->json([
                'success' => true,
                'data' => $count
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching discount count: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching discount count'
            ], 500);
        }
    }
}
