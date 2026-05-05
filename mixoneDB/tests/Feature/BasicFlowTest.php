<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicFlowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the homepage is accessible.
     */
    public function test_homepage_works(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test the dashboard redirects to login if not authenticated.
     */
    public function test_dashboard_redirects_to_login(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}
