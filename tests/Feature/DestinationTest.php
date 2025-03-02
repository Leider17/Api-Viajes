<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;
use App\Models\Destination;
use App\Models\User;

class DestinationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_all_destinations(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/destinations');

        $response->assertStatus(200)->assertJsonStructure([

            '*' => [
                'id',
                'name',
                'country',
                'description',
                'image',
                'created_at',
                'updated_at'
            ]
        ])->assertJsonCount(20);
    }

    public function test_list_destination():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/destinations/1');
        $response->assertStatus(200)->assertJsonStructure([
                'id',
                'name',
                'country',
                'description',
                'image',
                'created_at',
                'updated_at'
        ]);
    }

    public function test_create_destination():void{
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        
        $response=$this->post('/api/destinations',[
            'name' => 'nameDestination',
            'country' => 'Colombia',
            'description' => 'descriptionDestination',
            'image' => 'image.png'
        ]);
        
         $response->assertStatus(201)->assertJson([
            'success' => true,
            'data' => [
                'name' => 'nameDestination',
                'country' => 'Colombia',
                'description' => 'descriptionDestination',
                'image' => 'image.png'
    ]]);
    }

    public function test_delete_destination():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->delete('/api/destinations/1');
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }

    public function test_update_destination(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $destination = Destination::find(1);

        $response=$this->put('/api/destinations/1',[
            'name' => 'nametest',
            'country' => 'countrytest',
            'description' => 'descriptiontest',
            'image' => 'imagetest'
        ]);

        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }

    public function test_list_all_destinations_comments(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/api/destinations/comments');
        $response->assertStatus(200)->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'country',
                'description',
                'image',
                'comments' => [
                    '*' => [
                        'id',
                        'content',
                        'user_id',
                        'name_user',
                    ]
                ]
            ]
        ]);
    }

    public function test_list_destination_comments():void{
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/api/destinations/1/comments');
        $response->assertStatus(200)->assertJsonStructure([
                'id',
                'name',
                'country',
                'description',
                'image',
                'comments' => [
                    '*' => [
                        'id',
                        'content',
                        'user_id',
                        'name_user',
                    ]
                ]
                    ]);
    }

    public function test_list_all_destinations_hotels():void{
        
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/api/destinations/hotels');
        $response->assertStatus(200)->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'country',
                'description',
                'image',
                'hotels' => [
                    '*' => [
                        'id',
                        'name',
                        'address',
                        'price_night'
                    ]
                ]
            ]
        ]);
    }

    public function test_list_destination_hotels():void{
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/api/destinations/1/hotels');
        $response->assertStatus(200)->assertJsonStructure([
                'id',
                'name',
                'country',
                'description',
                'image',
                'hotels' => [
                    '*' => [
                        'id',
                        'name',
                        'address',
                        'price_night'
                    ]
                ]
                    ]);
    }

    public function test_list_all_destinations_activities():void{
        
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/api/destinations/activities');
        $response->assertStatus(200)->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'country',
                'description',
                'image',
                'activities' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'type'
                    ]
                ]
            ]
        ]);
    }

    public function test_list_destination_activity():void{
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/api/destinations/1/activities');
        $response->assertStatus(200)->assertJsonStructure(['id',
                'name',
                'country',
                'description',
                'image',
                'activities' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'type'
                    ]
                    ]]);
    }

}


