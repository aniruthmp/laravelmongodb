<?php

namespace App\Http\Controllers;

use App\Entity\Car;
use App\Entity\Owner;
use App\Entity\Part;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    public function random()
    {
        $faker = Factory::create();
        $car = new Car();
        $car->licensePlate = $faker->isbn10;
        $car->make = $faker->company;
        $car->model = $faker->word;
        $car->year = $faker->year;
        $car->price = $faker->randomNumber(5);
        $car->save();

        for ($x = 0; $x <= $faker->randomNumber(1); $x++) {
            $part = new Part();
            $part->name = $faker->swiftBicNumber;
            $part->number = $faker->iban('US');
            $car->parts()->save($part);
        }

        $owner = new Owner();
        $owner->firstName = $faker->firstName;
        $owner->lastName = $faker->lastName;
        $owner->save();

        $owner->cars()->save($car);
        $car->owner()->associate($owner);
        $car->save();

        return json_encode($car);
    }

    public function update($id) {
        $car = Car::find($id);
        // Added this for good coding. Functionality is unaffected if this is removed
        /** @var $owner Owner */
        $owner = $car->owner;

        $owner->firstName = strtoupper($owner->firstName);
        $owner->save();

        $car->owner()->associate($owner);
        $car->save();

        return json_encode($car);
    }

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
