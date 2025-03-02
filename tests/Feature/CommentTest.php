<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Comment;

class CommentTest extends TestCase
{
    public function test_list_all_comments(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/comments');

        $response->assertStatus(200)->assertJsonStructure([

            '*' => [
                'id',
                'content',
                'user_id',
                'destination_id'
            ]
        ])->assertJsonCount(50);
    }

    public function test_list_comment():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/api/comments/1');
        $response->assertStatus(200)->assertJsonStructure([
                'id',
                'content',
                'user_id',
                'destination_id'
        ]);
    }

    public function test_create_comment():void{
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        
        $response=$this->post('/api/comments',[
            'content'=>'content',
            'destination_id'=>1,
            'user_id'=>1
        ]);
        
         $response->assertStatus(201)->assertJson([
            'success' => true,
            'data' => [
                'content'=>'content',
                'destination_id'=>1,
                'user_id'=>1
    ]]);
    }

    public function test_delete_comment():void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->delete('/api/comments/1');
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }

    public function test_update_comment(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');


        $response=$this->put('/api/comments/1',[
            
                'content'=>'contentTest',
                'user_id'=>1,
                'destination_id'=>1
        ]);
       
        $response->assertStatus(200)
        ->assertJsonStructure(['success']);
    }
}


