<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRisksRequest extends FormRequest
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
            'parent_id' => 'max:2147483647|nullable|numeric',
            'score' => 'max:2147483647|nullable|numeric',
            'impact' => 'max:2147483647|nullable|numeric',
            'probability' => 'max:2147483647|nullable|numeric',
            'resolved' => 'max:2147483647|nullable|numeric',
            'risk_date' => 'nullable|date_format:'.config('app.date_format'),
            'version_date' => 'nullable|date_format:H:i:s',
            'type' => 'max:2147483647|nullable|numeric',
        ];
    }
}
