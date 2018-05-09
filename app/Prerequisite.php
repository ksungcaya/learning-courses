<?php

namespace App;

use App\Course;
use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'course_prerequisites';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Allow mass assignments.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @return Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
