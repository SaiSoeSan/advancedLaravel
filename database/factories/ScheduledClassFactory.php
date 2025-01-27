<?php

namespace Database\Factories;

use App\Models\ScheduledClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduledClass>
 */
class ScheduledClassFactory extends Factory
{

    protected $model = ScheduledClass::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => rand(15, 24),
            'class_type_id' => rand(1, 4),
            'date_time' => Carbon::now()->addHour(rand(24, 120))->minute(0)->second(0)
        ];
    }
}
