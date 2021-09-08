<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

use App\Models\User;
use App\Models\phonebooks;

class PhonebooksTest extends TestCase
{

    use HasApiTokens, HasFactory, RefreshDatabase;

    /**
     * Test the create route.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $Data = [
            "firstName"=> "Parth",
            "lastName"=> "Patel",
            "email"=> "admin@gmail.com",
            "mobileNumber"=> "07459169377"
        ];
        $this->json('POST', 'api/phonebooks/', $Data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "data" => $Data,
                "message" => "Created successfully"
            ]
            );
    }

    /**
     * Test the update route.
     *
     * @return void
     */
    public function testUpdate(){
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $phonebooks = phonebooks::factory()->create([
            "firstName"=> "Parth",
            "lastName"=> "Patel",
            "email"=> "admin@gmail.com",
            "mobileNumber"=> "07459169377"
        ]);

        $payload = [
            "firstName"=>"Parth",
            "lastName"=>"Patel",
            "email"=>"webdeveloper.parth@gmail.com",
            "mobileNumber"=>"07459169377",
            "phoneNumber" => "+1.934.506.1355"
        ];

        $this->json('PATCH', 'api/phonebooks/' . $phonebooks->id , $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "data" => $payload,
                "message" => "Updated successfully"
            ]);
    }

    //Test the single show route
    public function testShow(){
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $phonebooks = phonebooks::factory()->create([
            "firstName"=> "Parth",
            "lastName"=> "Patel",
            "email"=> "admin@gmail.com",
            "mobileNumber"=> "07459169377"
        ]);

        $this->json('GET', 'api/phonebooks/' . $phonebooks->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "data" => $phonebooks,
                "message" => "Successfully"
            ]);
    }

    /**
     * Test the delete route.
     *
     * @return void
     */
    public function testDelete(){
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $phonebooks = phonebooks::factory()->create([
            "firstName"=> "Parth",
            "lastName"=> "Patel",
            "email"=> "admin@gmail.com",
            "mobileNumber"=> "07459169377"
        ]);

        $this->json('DELETE', 'api/phonebooks/' . $phonebooks->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "data" => $phonebooks,
                "message" => "Successfully"
            ]);
    }

}
