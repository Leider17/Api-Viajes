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
}
