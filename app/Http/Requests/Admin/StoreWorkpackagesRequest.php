<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkpackagesRequest extends FormRequest
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
            'order' => 'max:2147483647|nullable|numeric',
            'deliverables.*.confidentiality' => 'max:2147483647|nullable|numeric',
            'deliverables.*.due_date_months' => 'max:2147483647|nullable|numeric',
        ];
    }
}
