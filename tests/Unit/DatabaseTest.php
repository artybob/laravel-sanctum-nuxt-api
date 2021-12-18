<?php

namespace Tests\Unit;

use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_starting_data()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com'
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'writer'
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'admin'
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'user'
        ]);
    }
}
