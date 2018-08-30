<?php

use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('cars')->delete();
        DB::collection('cars')->insert(['carcompany' => 'BMW', 'model' => '335i', 'price' => '$50,000']);
    }
}
