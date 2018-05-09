<?php

namespace App;

use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    /**
     * Allow mass assignments.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Eager load course relationship.
     *
     * @var array
     */
    protected $with = ['course'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'done' => 'boolean'
    ];

    /**
     * @return Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark the course done.
     *
     * @return boolean
     */
    public function markDone()
    {
        $prerequisites = $this->course->prerequisites();
        $pre_req_ids = $prerequisites->pluck('pre_course_id');

        $finished_count = $this->user->courses()
            ->whereIn('course_id', $pre_req_ids)
            ->where('done', true)
            ->count();

        if ($prerequisites->count() != $finished_count) {
            return false;
        }

        $this->update(['done' => true]);

        return true;
    }
}
