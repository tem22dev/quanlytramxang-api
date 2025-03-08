<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_valid_phone_number()
    {
        $response = $this->post('/api/v1/login', ['user_identifier' => '012345678']);
        $response->assertStatus(200); // Kiểm tra xem có lỗi hay không
    }

    public function test_empty_username()
    {
        $response = $this->post('/api/v1/login', ['user_identifier' => '']);
        $response->assertSee('Vui lòng nhập đầy đủ các thông tin');
    }

    public function test_invalid_characters()
    {
        $response = $this->post('/api/v1/login', ['user_identifier' => 'abc{}@123.com']);
        $response->assertSee('Sai thông tin tài khoản');
    }

    public function test_login()
    {
        $response = $this->post('/api/v1/login', ['user_identifier' => 'abc{}@123.com', 'password' => 'root_admin_9999']);
        $response->assertSee(400);
    }

    public function test_login_pass()
    {
        $response = $this->post('/api/v1/login', ['user_identifier' => 'admin@gmail.com', 'password' => 'root_admin_9999']);
        $response->assertSee(200);
    }

    public function test_valid_password()
    {
        $response = $this->post('/api/v1/login', ['password' => 'P@ssw0rd']);
        $response->assertStatus(200)
                 ->assertJsonMissing(['error' => true]); // Không có lỗi
    }

    public function test_empty_password()
    {
        $response = $this->post('/api/v1/login', ['password' => '']);
        $response->assertStatus(422) // Laravel trả về 422 cho lỗi validation
                 ->assertJsonFragment(['message' => 'Vui lòng nhập đầy đủ các thông tin']);
    }

    public function test_short_password()
    {
        $response = $this->post('/api/v1/login', ['password' => '12345']);
        $response->assertStatus(422)
                 ->assertJsonFragment(['message' => 'Mật khẩu phải có ít nhất 8 ký tự']);
    }

    public function test_password_same_as_username()
    {
        $response = $this->post('/api/v1/login', [
            'username' => 'abc123',
            'password' => 'abc123'
        ]);
        $response->assertStatus(422)
                 ->assertJsonFragment(['message' => 'Mật khẩu không được trùng với tên tài khoản']);
    }

    public function test_password_only_lowercase()
    {
        $response = $this->post('/api/v1/login', ['password' => 'abcdef']);
        $response->assertStatus(422)
                 ->assertJsonFragment([
                     'message' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt'
                 ]);
    }

}
