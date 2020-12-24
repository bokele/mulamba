<?php

namespace App\Http\Controllers;

use App\Car;
use App\Country;
use App\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoutiqueController extends Controller
{
    // public function index()
    // {


    //     return view('pages.boutique');
    // }

    public function carDetail($id)
    {
        $car_brand = CarModel::orderBy('brand', 'asc')->groupBy('brand', 'car_models.id')->get();
        $countries = Country::orderBy('name', 'asc')->get();

        $car_sold =  Car::where('cars.id', $id)
            ->join('users', 'users.id', '=', 'cars.id')
            ->join('addresses', 'cars.address_id', '=', 'addresses.id')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')

            ->select(
                'cars.*',
                'car_models.brand as brand',
                'car_models.model as model',
                'car_models.vehicle_type as vehicle_type',
                'car_models.year as year',
                'users.name as name',
                'users.email as email',
                'countries.name as country_name'
            )->firstOrFail();

        if (\Route::current()->getName() == "boutiques.car.detail") {

            return view('pages.car.car-detail', ['car' => $car_sold]);
        }
        if (\Route::current()->getName() == "boutiques.car.propose.price") {

            if (Auth::check()) {
                return view('pages.car.propose', [
                    'car_sold' => $car_sold,

                    'car_id' => $id,
                    'car_brand' => $car_brand,
                    'countries' => $countries,
                ]);
            } else {
                return redirect()->intended('/login');

                // return redirect('/login');
            }
        }
    }
    public function carProposePrice($id)
    {
        $car =  Car::where('cars.id', $id)
            ->join('users', 'users.id', '=', 'cars.id')
            ->join('addresses', 'cars.address_id', '=', 'addresses.id')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')

            ->select(
                'cars.*',
                'car_models.brand as brand',
                'car_models.model as model',
                'car_models.vehicle_type as vehicle_type',
                'car_models.year as year',
                'users.name as name',
                'users.email as email',
                'countries.name as country_name'
            )->firstOrFail();

        return view('pages.car.car-detail', ['car' => $car,]);
    }
    public function getCar()
    {
        $cars =  Car::where('cars.status', 'sale')
            ->orWhere('cars.status', 'rent')
            ->join('users', 'users.id', '=', 'cars.id')
            ->join('addresses', 'cars.address_id', '=', 'addresses.id')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')

            ->select(
                'cars.*',
                'car_models.brand as brand',
                'car_models.model as model',
                'car_models.vehicle_type as vehicle_type',
                'car_models.year as year',
                'users.name as name',
                'users.email as email',
                'countries.name as country_name'
            )->paginate(3);

        return view('pages.car.car', compact('cars'));
    }

    public function getAllCar()
    {
        $cars =  Car::where('cars.status', 'sale')
            ->orWhere('cars.status', 'rent')
            ->join('users', 'users.id', '=', 'cars.id')
            ->join('addresses', 'cars.address_id', '=', 'addresses.id')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')

            ->select(
                'car_solds.*',
                'car_models.brand as brand',
                'car_models.model as model',
                'car_models.vehicle_type as vehicle_type',
                'car_models.year as year',
                'users.name as name',
                'users.email as email',
                'countries.name as country_name'
            )->paginate(3);
        dd($cars);
        return view('pages.car.car_pagination_data', compact('cars'));
    }
}
