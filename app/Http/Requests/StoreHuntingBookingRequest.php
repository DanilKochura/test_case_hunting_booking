<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreHuntingBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tour_name' => 'required|string|max:255',
            'hunter_name' => 'required|string|max:255',
            'guide_id' => 'required|exists:guides,id',
            'date' => 'required|date|after:today',
            'participants_count' => 'required|integer|min:1|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'tour_name.required' => 'Название тура обязательно для заполнения.',
            'hunter_name.required' => 'Имя охотника обязательно для заполнения.',
            'guide_id.required' => 'Выбор гида обязателен.',
            'guide_id.exists' => 'Выбранный гид не существует.',
            'date.required' => 'Дата бронирования обязательна.',
            'date.after' => 'Дата бронирования должна быть в будущем.',
            'participants_count.required' => 'Количество участников обязательно.',
            'participants_count.integer' => 'Количество участников должно быть числом.',
            'participants_count.min' => 'Минимальное количество участников: 1.',
            'participants_count.max' => 'Максимальное количество участников: 10.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Ошибка валидации',
            'errors' => $validator->errors(),
        ], 422));
    }
}
