<?php

namespace App\Actions;

use App\Models\Enrollment;

class ApproveEnrollmentAction
{
    public function handle(Enrollment $enrollment): Enrollment
    {
        abort_if($enrollment->status !== 'pending', 400, 'Enrollment is not pending');

        $enrollment->update([
            'status' => 'approved'
        ]);

        $enrollment->course()->decrement('seats', $enrollment->seats_requested);

        return $enrollment;
    }
}
