<?php

namespace Tests\Unit;

use Tests\TestCase;

class FuelNameTest extends TestCase
{
    /**
     * TC_061: Nhập tên nhiên liệu hợp lệ
     */
    public function test_valid_fuel_name()
    {
        $response = $this->post('/api/v1/fuel', ['fuel_name' => 'Xăng 95']);
        $response->assertStatus(200)
                 ->assertJsonMissing(['error' => true]); // Không có lỗi
    }

    /**
     * TC_062: Nhập tên nhiên liệu trống
     */
    public function test_empty_fuel_name()
    {
        $response = $this->post('/api/v1/fuel', ['fuel_name' => '']);
        $response->assertStatus(422)
                 ->assertJsonFragment(['message' => 'Vui lòng nhập đầy đủ thông tin']);
    }

    /**
     * TC_063: Nhập tên nhiên liệu có ký tự đặc biệt
     */
    public function test_fuel_name_with_special_characters()
    {
        $response = $this->post('/api/v1/fuel', ['fuel_name' => '@Xăng#95!']);
        $response->assertStatus(422)
                 ->assertJsonFragment(['message' => 'Tên nhiên liệu không hợp lệ']);
    }

    /**
     * TC_064: Nhập tên nhiên liệu chỉ chứa số
     */
    public function test_fuel_name_only_numbers()
    {
        $response = $this->post('/api/v1/fuel', ['fuel_name' => '123456']);
        $response->assertStatus(422)
                 ->assertJsonFragment(['message' => 'Tên nhiên liệu không hợp lệ']);
    }

    /**
     * TC_065: Nhập tên nhiên liệu có độ dài tối đa
     */
    public function test_fuel_name_max_length()
    {
        $maxLengthString = str_repeat('A', 255); // Chuỗi 255 ký tự
        $response = $this->post('/api/v1/fuel', ['fuel_name' => $maxLengthString]);
        $response->assertStatus(200)
                 ->assertJsonMissing(['error' => true]); // Không có lỗi

        $overMaxLengthString = str_repeat('A', 256); // Chuỗi 256 ký tự (quá giới hạn)
        $response = $this->post('/api/v1/fuel', ['fuel_name' => $overMaxLengthString]);
        $response->assertStatus(422)
                 ->assertJsonFragment(['message' => 'Tên nhiên liệu vượt quá độ dài cho phép']);
    }
}
