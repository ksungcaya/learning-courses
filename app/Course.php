<?php

namespace App;

use App\Prerequisite;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
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
     * Eager load course relationship.
     *
     * @var array
     */
    protected $with = ['prerequisites'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prerequisites()
    {
        return $this->hasMany(Prerequisite::class);
    }
}
