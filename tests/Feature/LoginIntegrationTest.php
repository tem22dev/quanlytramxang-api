<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginIntegrationTest extends TestCase
{
    use RefreshDatabase;

    private $accessToken;

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
     * IT_001: Gửi thông tin đăng nhập hợp lệ đến máy chủ và lấy access token
     */
    public function test_login_with_valid_credentials()
    {
        $user = \App\Models\User::factory()->create([
            // 'full_name' => 'John Doe',
            'tel' => '0912312392',
            'email' => 'test123@gmail.com',
            'full_name' => 'John Doe',
            'user_type' => '1',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'user_identifier' => '12345678',
            'password' => 'P@ssw0rd',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['data.token']); // Kiểm tra có token hay không
    }

    /**
     * IT_002: Gửi thông tin đăng nhập không hợp lệ đến máy chủ
     */
    public function test_login_with_invalid_credentials()
    {
        $user = \App\Models\User::factory()->create([
            'full_name' => 'John Doe',
            'email' => '12345678',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => '12345678',
            'password' => 'wrongpass',
        ]);

        $response->assertStatus(401)
                 ->assertJsonFragment(['message' => 'Thông tin đăng nhập không chính xác']);
    }

    /**
     * IT_003: Kiểm tra truy cập API yêu cầu xác thực với Access Token
     */
    public function test_access_protected_api_with_token()
    {
        // Đầu tiên, thực hiện đăng nhập để lấy token
        // $this->test_login_with_valid_credentials();

        // Kiểm tra nếu token được tạo
        // $this->assertNotNull($this->accessToken, 'Không lấy được access token');

        // Gửi request đến API bảo vệ bằng token
        $response = $this->getJson('/api/v1/user', [
            'Authorization' => 'Bearer ' . $this->accessToken,
        ]);

        $response->assertStatus(200);
    }

    /**
     * IT_004: Thử đăng nhập khi máy chủ không phản hồi
     */
    public function test_login_when_server_is_down()
    {
        // Mô phỏng lỗi máy chủ bằng cách tắt API hoặc mô phỏng lỗi mạng
        $this->withoutExceptionHandling();

        $response = $this->postJson('/api/v1/login', [
            'user_identifier' => '12345678',
            'password' => 'P@ssw0rd',
        ]);

        $response->assertStatus(500)
                 ->assertJsonFragment(['message' => 'Không thể kết nối đến máy chủ']);
    }
}
