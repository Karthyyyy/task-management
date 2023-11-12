<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\TasksSeeder;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_retrieve_all_tasks(): void {
        $this->actingAs($user = User::factory()->create());
        $this->seed(TasksSeeder::class);

        $response = $this->get('api/v1/tasks', [
            'user_id' => $user->id
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(5, $key = 'data');
    }

    public function test_can_retrieve_task(): void {
        $this->actingAs($user = User::factory()->create());
        $this->seed(TasksSeeder::class);

        $response = $this->get('api/v1/tasks/1', [
            'user_id' => $user->id
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_can_create_task(): void {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post('api/v1/tasks', [
            'user_id' => $user->id,
            'title' => 'Test Title',
            'description' => 'Test description',
            'due_date' => Carbon::now()->addDay(5),
            'status' => 'pending',
            'files' => ''
        ]);

        $task = Tasks::find(1);

        $response->assertStatus(302);
        $this->assertModelExists($task);
    }

    public function test_can_edit_task(): void {
        $this->actingAs($user = User::factory()->create());
        $this->seed(TasksSeeder::class);

        $task = Tasks::find(1);
        $response = $this->post('api/v1/tasks', [
            'id' => 1,
            'user_id' => $user->id,
            'title' => 'Test Title',
            'description' => 'Test description',
            'due_date' => Carbon::now()->addDay(5),
            'status' => 'pending',
            'files' => ''
        ]);

        $task = Tasks::find(1);

        $response->assertStatus(302);
        $this->assertModelExists($task);
        $this->assertDatabaseHas('tasks', [
            'id' => 1,
            'title' => 'Test Title'
        ]);
    }

    public function test_can_delete_task(): void {
        $this->actingAs($user = User::factory()->create());
        $this->seed(TasksSeeder::class);

        $task = Tasks::find(2);
        $response = $this->delete('api/v1/tasks/2', [
            'user_id' => $user->id
        ]);

        $response->assertStatus(200);
        $this->assertModelMissing($task);
    }
}
