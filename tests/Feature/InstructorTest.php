<?php

namespace Tests\Feature;

use App\Models\ClassType;
use App\Models\ScheduledClass;
use App\Models\User;
use Database\Seeders\ClassTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstructorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_instructor_is_redirected_to_instructor_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirectToRoute('instructor.dashboard');
    }

    public function test_instructor_can_schedule_a_class(): void
    {
        //Arrange
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);
        $this->seed(ClassTypeSeeder::class);

        //Action
        $response = $this
            ->actingAs($user)
            ->post('/instructor/schedule', [
                'class_type_id' => ClassType::first()->id,
                'date' => '2025-01-30',
                'time' => '09:00:00'
            ]);

        //Assert
        $response->assertRedirectToRoute('schedule.index');
    }

    public function test_instructor_can_cancel_a_class(): void
    {
        //Arrange
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);
        $this->seed(ClassTypeSeeder::class);

        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2025-01-30 09:00:00'
        ]);

        //Action
        $response = $this->actingAs($user)
            ->delete('/instructor/schedule/' . $scheduledClass->id);

        //Assert
        $this->assertDatabaseMissing('scheduled_classes', [
            'id' => $scheduledClass->id
        ]);
    }

    public function test_cannot_cancel_a_class_less_than_two_hours_before(): void
    {
        //Arrange
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);
        $this->seed(ClassTypeSeeder::class);

        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => now()->addHours(1)->addMinutes(0)->addSeconds(0)
        ]);


        //Action

        $response = $this->actingAs($user)
            ->get('instructor/schedule');

        $response->assertDontSeeText('Cancel');

        $this->actingAs($user)
            ->delete('/instructor/schedule/' . $scheduledClass->id);

        //Assert
        $this->assertDatabaseHas('scheduled_classes', [
            'id' => $scheduledClass->id
        ]);
    }
}
