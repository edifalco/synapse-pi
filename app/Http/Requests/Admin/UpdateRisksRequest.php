<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRisksRequest extends FormRequest
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
            
            'version' => 'max:2147483647|nullable|numeric',
            'date' => 'nullable|date_format:'.config('app.date_format'),
            'score' => 'max:2147483647|nullable|numeric',
            'version_date' => 'nullable|date_format:H:i:s',
            'parent_id' => 'max:2147483647|nullable|numeric',
        ];
    }
}
