<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Hotel;

class HotelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_all_hotels(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/hotels');

        $response->assertStatus(200)->assertJsonStructure([

            '*' => [
                'id',
                'name',
                'address',
                'price_night',
                'destination_id'
            ]
        ])->assertJsonCount(30);
    }

    public function test_list_hotel():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/hotels/1');
        $response->assertStatus(200)->assertJsonStructure([
                'id',
                'name',
                'address',
                'price_night',
                'destination_id'
        ]);
    }

    public function test_create_hotwl():void{
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        
        $response=$this->post('/api/hotels',[
            'name'=>'name',
            'address'=>'address',
            'price_night'=>1000,
            'destination_id'=>1
        ]);
        
         $response->assertStatus(201)->assertJson([
            'success' => true,
            'data' => [
                'name'=>'name',
                'address'=>'address',
                'price_night'=>1000,
                'destination_id'=>1
    ]]);
    }

    public function test_delete_hotel():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->delete('/api/hotels/1');
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }

    public function test_update_hotel(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');


        $response=$this->put('/api/hotels/1',[
                'name'=>'nameTest',
                'address'=>'addressTest',
                'price_night'=>100,
                'destination_id'=>1
        ]);
       
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }
}
