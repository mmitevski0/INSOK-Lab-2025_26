<?php

namespace App\Actions;

use App\Models\Course;

class DeleteCourseAction
{
    public function handle(Course $course): void
    {
        abort_if(
            $course->enrollments()->where('status', 'approved')->exists(),
            400,
            'Cannot delete course with approved enrollments'
        );

        $course->enrollments()->delete();
        $course->delete();
    }
}
