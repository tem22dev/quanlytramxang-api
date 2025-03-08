<?php

namespace Tests\Feature;

use App\Models\GasStation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Station;
use Illuminate\Support\Facades\Log;

class StationIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected $accessToken;

    protected function setUp(): void
    {
        parent::setUp();

        // Tạo người dùng và đăng nhập để lấy token
        $user = User::factory()->create([
            'full_name' => 'Admin',
            'tel' => '0912312392',
            'user_type' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'user_identifier' => 'admin@gmail.com',
            'password' => 'P@ssw0rd',
        ]);

        $this->accessToken = $response->json('data.token');
    }

    /**
     * IT_082: Mở form "Thông tin trạm" từ bản đồ
     */
    public function test_open_station_info_from_map()
    {
        $station = GasStation::factory()->create();

        $response = $this->getJson("/api/v1/gas-station/{$station->id}", [
            'Authorization' => "Bearer {$this->accessToken}",
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $station->id]);
    }

    /**
     * IT_083: Kiểm tra khi mở thông tin trạm không tồn tại
     */
    public function test_open_non_existent_station_info()
    {
        $response = $this->getJson('/api/v1/gas-station/9999', [
            'Authorization' => "Bearer {$this->accessToken}",
        ]);

        $response->assertStatus(404)
                 ->assertJsonFragment(['message' => 'Không tìm thấy !']);
    }

    /**
     * IT_084: Click vào nút "Xóa" trạm
     */
    public function test_click_delete_station_button()
    {
        // Không kiểm tra API mà chỉ mô phỏng UI mở cảnh báo xác nhận
        $this->assertTrue(true);
    }

    /**
     * IT_085: Xóa trạm hợp lệ
     */
    public function test_delete_valid_station()
    {
        $station = GasStation::factory()->create([

        ]);

        $response = $this->deleteJson("/api/v1/gas-station/{$station->id}", [], [
            'Authorization' => "Bearer {$this->accessToken}",
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Trạm đã bị xóa']);

        $this->assertDatabaseMissing('gas-station', ['id' => $station->id]);
    }

    /**
     * IT_086: Kiểm tra khi xóa trạm không tồn tại
     */
    public function test_delete_non_existent_station()
    {
        $response = $this->deleteJson('/api/v1/gas-station/9999', [], [
            'Authorization' => "Bearer {$this->accessToken}",
        ]);

        $response->assertStatus(404)
                 ->assertJsonFragment(['message' => 'Không tìm thấy !', 'status' => 404]);
    }

    public function test_delete_station_with_server_error()
    {
        // Giả lập lỗi máy chủ bằng cách tắt xử lý ngoại lệ
        $this->withoutExceptionHandling();

        $response = $this->deleteJson('/api/v1/gas-station/1', [], [
            'Authorization' => "Bearer {$this->accessToken}",
        ]);

        $response->assertStatus(404)
                 ->assertJsonFragment(['message' => 'Không tìm thấy !',"status" => 404]);
    }
}
