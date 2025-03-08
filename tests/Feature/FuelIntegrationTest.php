<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Fuel;

class FuelIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function it_displays_the_fuel_list_correctly()
    {
        Fuel::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/fuel');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'price', 'description']
                ]
            ]);
    }

    /** @test */
    public function it_displays_fuel_price_in_correct_format()
    {
        $fuel = Fuel::factory()->create(['price' => 99000]);

        $response = $this->getJson('/api/v1/fuel');

        $response->assertStatus(200)
            ->assertJsonFragment(['price' => '99.000 đ']);
    }

    /** @test */
    public function it_displays_fuel_description_correctly()
    {
        $fuel = Fuel::factory()->create(['description' => 'Mô tả nhiên liệu mẫu']);

        $response = $this->getJson('/api/v1/fuel');

        $response->assertStatus(200)
            ->assertJsonFragment(['description' => 'Mô tả nhiên liệu mẫu']);
    }

    /** @test */
    public function it_supports_pagination_correctly()
    {
        Fuel::factory()->count(15)->create();

        $response = $this->getJson('/api/v1/fuel?page=2');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data', 'links', 'meta' => ['current_page']
            ])
            ->assertJsonFragment(['current_page' => 2]);
    }
}
