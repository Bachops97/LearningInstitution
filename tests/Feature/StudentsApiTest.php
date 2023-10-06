<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Student;

class StudentsApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving all students via API.
     *
     * @return void
     */
    public function testGetAllStudents()
    {
        // Arrange: Create some sample students in the database
        Student::factory()->count(3)->create();

        // Act: Make a GET request to the API endpoint
        $response = $this->get('/api/students');

        // Assert: Verify the response status code and JSON structure
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'name',
                         'age'
                     ],
                 ]);
    }
}
