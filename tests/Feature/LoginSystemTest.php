<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginSystemTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Tạo user để test đăng nhập
        User::factory()->create([
            'id' => 12345678,
            'password' => bcrypt('P@ssw0rd'),
            'status' => 'active', // Giả sử status là 'active' cho tài khoản bình thường
        ]);
    }

    /** @test */
    public function st_001_dang_nhap_thanh_cong()
    {
        $response = $this->post('/login', [
            'id' => 12345678,
            'password' => 'P@ssw0rd',
        ]);

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function st_002_dang_nhap_that_bai_voi_mat_khau_sai()
    {
        $response = $this->post('/login', [
            'id' => 12345678,
            'password' => 'wrongpass',
        ]);

        $response->assertSessionHasErrors(['id' => 'Sai mã số hoặc mật khẩu']);
    }

    /** @test */
    public function st_003_dang_nhap_that_bai_voi_tai_khoan_khong_ton_tai()
    {
        $response = $this->post('/login', [
            'id' => 87654321,
            'password' => 'P@ssw0rd',
        ]);

        $response->assertSessionHasErrors(['id' => 'Sai mã số hoặc mật khẩu']);
    }

    /** @test */
    public function st_004_dang_nhap_that_bai_khi_tai_khoan_bi_khoa()
    {
        // Cập nhật trạng thái tài khoản bị khóa
        User::where('id', 12345678)->update(['status' => 'blocked']);

        $response = $this->post('/login', [
            'id' => 12345678,
            'password' => 'P@ssw0rd',
        ]);

        $response->assertSessionHasErrors(['id' => 'Tài khoản của bạn đã bị khóa']);
    }

    /** @test */
    public function st_005_dang_nhap_that_bai_khi_de_trong_ma_so_hoac_mat_khau()
    {
        $response = $this->post('/login', [
            'id' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['id', 'password']);
    }
}
