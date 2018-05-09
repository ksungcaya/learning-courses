<?php

namespace Tests\Unit;

use App\Course;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CourseTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_course_can_be_an_equivalent_of_another_course()
    {
        // TODO
        $course = factory(Course::class)->create(['name' =>'French - Elective 1']);
        $course_2 = factory(Course::class)->create(['name' =>'Spanish - Elective 1']);

        $this->assertTrue(true);
    }
}
