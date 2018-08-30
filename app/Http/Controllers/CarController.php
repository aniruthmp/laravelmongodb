<?php

namespace App\Http\Controllers;

use App\Part;
use App\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    public function findAll()
    {
        $cars = Car::all();
        return json_encode($cars);
    }

    public function findById($id)
    {
        $car = Car::find($id);
        return json_encode($car);
    }

    public function findByYear($year)
    {
        $yr = (int)$year;
        $cars = Car::where('year', $yr)->get();
        return json_encode($cars);
    }

    public function add(Request $request)
    {
        $car = Car::create($request->all());
        $parts = $request->parts;
        if (is_array($parts)) {
            foreach ($parts as $part) {
                $car->parts()->associate(Part::create($part));
                $car->save();
            }
        }
        $response = new Response(
            json_encode($car),
            Response::HTTP_CREATED
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function add_()
    {
        $car = new Car();
        $car->make = 'BMW';
        $car->model = '335i';
        $car->year = 2017;
        $car->price = 58500;
        $car->save();

        $car = Car::where('price', 58500)->first();
        $part = new Part();
        $part->number = 'b121';
        $part->name = 'engine part 123';
        $car->parts()->save($part);

        $part = new Part();
        $part->number = 'xy94';
        $part->name = 'Battery 830';
        $car->parts()->save($part);

        return json_encode($car);
    }

}
