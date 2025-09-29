<?php

use Tests\TestCase;
use App\Repositories\pkg_Parameters\CarCityRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarCityRepositoryTest extends TestCase
{
    public function test_get_all_data_success()
    {
        $repository = new CarCityRepository();
        $response = $repository->getAllCarCities();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function test_get_all_data_response_format()
    {
        $repository = new CarCityRepository();
        $response = $repository->getAllCarCities();
        $content = json_decode($response->getContent(), true);
        $this->assertIsArray($content);
    }

    public function test_get_all_data_http_status_code()
    {
        $repository = new CarCityRepository();
        $response = $repository->getAllCarCities();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
