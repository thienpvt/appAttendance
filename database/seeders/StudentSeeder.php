<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $faker = \Faker\Factory::create();

        for($i = 1; $i <= 500; $i++) {
            $arr[] = [
                'name' => $faker->name,
                'sid' => $faker->unique()->numberBetween(2101100000,2101199999),
                'birth_date' => $faker->dateTimeBetween('-30 years' ,'-18 years'),
                'course_id' => $faker->numberBetween(1,10),
            ];
                Student::insert($arr);
                $arr = [];
        }
    }
}
