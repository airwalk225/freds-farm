<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitCowsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_submit_a_new_cow() {
        $response = $this->post('/submit', [
            'name' => 'Fred',
            'breed' => 'Jersy',
            'age' => 7,
        ]);

        $this->assertDatabaseHas('cows', [
            'name' => 'Fred'
        ]);

        $response->assertStatus(302)
                 ->assertHeader('Location', url('/'));

        $this->get('/')
             ->assertSee('Fred');
    }

    /** @test */
    function cow_is_not_created_if_validation_fails() {
        $response = $this->post('/submit');

        $response->assertSessionHasErrors(['name', 'breed', 'age']);
    }
    
    /** @test */
    function max_length_succeeds_when_under_max() {
        $data = [
            'name' => str_repeat('a', 22),
            'breed' => str_repeat('a', 12),
            'age' => 3,
        ];
    
        $this->post('/submit', $data);
    
        $this->assertDatabaseHas('cows', $data);
    }
}
