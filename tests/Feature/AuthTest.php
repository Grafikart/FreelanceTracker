<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('Auth', function () {

    uses(RefreshDatabase::class);

    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('should redirect to login', function () {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    });

    it('should let the user access the dashboard if logged', function () {
        $response = $this->actingAs($this->user)->get('/');

        $response->assertStatus(200);
    });

    it('should show an error on failed login', function () {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    });

    it('should redirect to dashboard on success login', function () {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => '0000',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/');
    });

});
