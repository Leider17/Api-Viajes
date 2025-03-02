<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Activity;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_all_activities(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/activities');

        $response->assertStatus(200)->assertJsonStructure([

            '*' => [
                'id',
                'name',
                'description',
                'type'
            ]
        ])->assertJsonCount(25);
    }

    public function test_list_activity():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/activities/1');
        $response->assertStatus(200)->assertJsonStructure([
                'id',
                'name',
                'description',
                'type'
        ]);
    }


    public function test_create_activity():void{
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        
        $response=$this->post('/api/activities',[
        'name'=>'activityTest',
        'description'=>'description',
        'type'=>'tour',
        'destination_id'=>1
        ]);

        
         $response->assertStatus(201)->assertJson([
                'success' => true,
                'data' => [
                    'name'=>'activityTest',
                    'description'=>'description',
                    'type'=>'tour',
                    'destination_id'=>1
        ]]);
    }

    public function test_delete_activity():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->delete('/api/activities/1');
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }

    public function test_update_activity(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');


        $response=$this->put('/api/activities/1',[
            'name' => 'nametest',
            'description' => 'descriptiontest',
            'type' => 'typetest',
            'destination_id' => 1
        ]);
       
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }
}
