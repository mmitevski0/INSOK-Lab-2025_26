<?php

namespace App\Http\Controllers;

use App\Actions\ApproveEnrollmentAction;
use App\Http\Requests\EnrollmentRequest;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return Enrollment::query()
            ->with('course:id,title')
            ->get();
    }

    public function store(EnrollmentRequest $request)
    {
        $enrollment = Enrollment::query()->create($request->validated());

        return response()->json($enrollment, 201);
    }

    public function approve(Enrollment $enrollment, ApproveEnrollmentAction $action)
    {
        $enrollment = $action->handle($enrollment);

        return response()->json($enrollment);
    }

    public function drop(Enrollment $enrollment)
    {
        abort_if($enrollment->status !== 'approved', 400, 'Enrollment is not approved');

        $enrollment->update([
            'status' => 'dropped'
        ]);

        return response()->json($enrollment);
    }
}
