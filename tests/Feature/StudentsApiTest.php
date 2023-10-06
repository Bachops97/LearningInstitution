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

        Student::factory()->count(3)->create();


        $response = $this->get('/api/students');


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
