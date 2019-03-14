<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliverablesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'date' => 'nullable|date_format:'.config('app.date_format'),
            'confidentiality' => 'max:2147483647|nullable|numeric',
            'submission_date' => 'nullable|date_format:'.config('app.date_format'),
            'due_date_months' => 'max:2147483647|nullable|numeric',
            'responsible.*' => 'exists:members,id',
        ];
    }
}
