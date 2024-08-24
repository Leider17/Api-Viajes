<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;

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
        $response = $this->get('/api/Destinations');

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
        $response = $this->get('/api/Destinations/1');
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

    public function test_delete_destination():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
        $response = $this->delete('/api/Destinations/1');
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }

    public function test_update_destination(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_list_all_destinations_comments(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/api/DestinationsComments');
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

        $response = $this->get('/api/DestinationsComments/1');
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

        $response = $this->get('/api/DestinationsHotels');
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

        $response = $this->get('/api/DestinationsHotels/1');
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

        $response = $this->get('/api/DestinationsActivities');
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

        $response = $this->get('/api/DestinationsActivities/1');
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


