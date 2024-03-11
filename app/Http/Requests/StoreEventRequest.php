<?php

// StoreEventRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'seats' => 'required|integer|min:1',
            'date' => 'required|date|after:today',
            'price' => 'required|integer|min:0',
            'type' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:pending,accepted,refused',
            'category_id' => 'required|exists:categories,id',
            'created_by' => 'required|exists:users,id',
        ];
    }
}
