<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Tests\TestCase;

use App\Models\User;
use App\Models\phonebooks;

class PhonebooksTest extends TestCase
{

    use HasApiTokens, HasFactory, RefreshDatabase;

    protected function authenticate(){
        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $this->user = $user;
        $token = $user->createToken('MyApp')->accessToken;;
        return $token;
    }

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

        $this->json('POST', 'phonebooks', $Data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                "data" => $Data,
                "message" => "Created successfully"
            ]);
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
            ->assertStatus(204);
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
            ->assertStatus(204);
    }

}
