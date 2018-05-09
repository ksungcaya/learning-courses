<?php

namespace Tests\Unit;

use App\User;
use App\Course;
use App\UserCourse;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_courses()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();

        $user_course = factory(UserCourse::class)->create(['user_id' => $user->id, 'course_id' => $course->id]);

        $this->assertEquals($user->id, $user_course->user_id);
        $this->assertEquals($course->id, $user_course->course_id);
    }

    /** @test */
    public function a_user_can_not_mark_the_course_done_if_prerequisite_is_not_yet_done()
    {
        $user = factory(User::class)->create();
        $pre_req = factory(Course::class)->create(['name' => 'Course - 1']);

        $course = factory(Course::class)->create(['name' => 'Course - 2']);
        $course->prerequisites()->create(['pre_course_id' => $pre_req->id]);

        // add course and pre-requisite to a user
        $user_pre_req = $user->courses()->create(['course_id' => $pre_req->id]);
        $user_course = $user->courses()->create(['course_id' => $course->id]);

        $this->assertFalse($user_course->markDone());
    }

    /** @test */
    public function a_user_can_mark_a_course_done_given_all_pre_requisites_were_also_done()
    {
        $user = factory(User::class)->create();
        $pre_req = factory(Course::class)->create(['name' => 'Course - 1']);
        $pre_req2 = factory(Course::class)->create(['name' => 'Course - 1.1']);

        $course = factory(Course::class)->create(['name' => 'Course - 2']);
        $course->prerequisites()->createMany([
            ['pre_course_id' => $pre_req->id],
            ['pre_course_id' => $pre_req2->id],
        ]);

        // add course and pre-requisite to a user
        $user_pre_req = $user->courses()->createMany([
            ['course_id' => $pre_req->id],
            ['course_id' => $pre_req2->id]
        ]);

        $user_course = $user->courses()->create(['course_id' => $course->id, 'done' => false]);

        // mark the pre-requisites first
        $this->assertTrue($user_pre_req[0]->markDone());
        $this->assertTrue($user_pre_req[1]->markDone());

        $this->assertTrue($user_course->markDone());
        $this->assertTrue($user_course->done);
    }
}
