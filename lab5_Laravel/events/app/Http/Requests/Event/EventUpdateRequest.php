<?php

namespace App\Http\Requests\Event;

use App\Enums\EventTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20|max:255',
            'type' => [
                'required',
                Rule::in(EventTypeEnum::cases()),
            ],
            'date' => 'required|date|after_or_equal:date',
            'organizer_id' => [
                'required',
                Rule::exists('organizers', 'id'),
            ],
        ];
    }
}
