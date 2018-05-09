<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursePrerequisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_prerequisites', function (Blueprint $table) {
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('pre_course_id');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_prerequisites');
    }
}
