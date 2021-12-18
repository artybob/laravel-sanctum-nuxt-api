<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ApiTest extends TestCase
{
    CONST FAKE_EMAIL = 'test@test123sssssssdasdaswdqwzxczxcasd.test';
    CONST FAKE_PASSWORD = 'password';

    public function test_register()
    {
        User::where('email', self::FAKE_EMAIL)->delete();

        $response = $this->post('/register', [
            'name' => 'test',
            'email' => self::FAKE_EMAIL,
            'password' => bcrypt(self::FAKE_PASSWORD),
        ]);

        $response->assertStatus(200);
    }

    public function test_login()
    {

        $response = $this->post('/login', [
            'name' => 'test',
            'email' => self::FAKE_EMAIL,
            'password' => self::FAKE_PASSWORD,
        ]);

        $response->assertStatus(200);

        $this->assertAuthenticatedAs( User::where('email', self::FAKE_EMAIL)->first());

        User::where('email', self::FAKE_EMAIL)->delete();
    }

}
