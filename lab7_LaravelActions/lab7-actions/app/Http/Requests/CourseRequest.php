<?php

namespace App\Http\Requests;

use App\Enums\CourseLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'level' => ['required', Rule::in(CourseLevelEnum::cases())],
            'seats' => 'required|integer|min:1',
            'start_date' => 'required|date',
        ];
    }
}
