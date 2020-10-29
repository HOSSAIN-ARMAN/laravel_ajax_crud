<?php

use Illuminate\Database\Seeder;
use App\Division;

class DevisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::insert([
            [
                "id"=> 1,
                "name"=> "Barishal"
            ],
            [
                "id"=> 2,
                "name"=> "Chattogram"
            ],
            [
                "id"=> 3,
                "name"=> "Dhaka"
            ],
            [
                "id"=> 4,
                "name"=> "Khulna"
            ],
            [
                "id"=> 5,
                "name"=> "Mymensingh"
            ],
            [
                "id"=> 6,
                "name"=> "Rajshahi"
            ],
            [
                "id"=> 7,
                "name"=> "Rangpur"
            ],
            [
                "id"=> 8,
                "name"=> "Sylhet"
            ],
        ]);
    }
}
