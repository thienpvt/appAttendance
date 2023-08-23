<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         Course::factory(10)->create();
//         Subject::factory(10)->create();
         $this->call(StudentSeeder::class);
    }
}
