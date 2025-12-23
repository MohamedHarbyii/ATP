<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoachRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone'=>'sometimes|nullable',
            'games' => 'required|array|min:1', 
            'image'=>'nullable|image',
            
            'games.*' => 'exists:games,id', 
        ];
    }

    // (اختياري) رسائل بالعربي لو حابب
    public function messages()
    {
        return [
            'games.*.exists' => 'لعبة من الألعاب المختارة غير موجودة في السيستم.',
        ];
    }
}