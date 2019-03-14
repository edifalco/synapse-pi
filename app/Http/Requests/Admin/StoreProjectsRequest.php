<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectsRequest extends FormRequest
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
            'duration' => 'max:2147483647|nullable|numeric',
            'partners.*' => 'exists:partners,id',
            'deliverables.*.confidentiality' => 'max:2147483647|nullable|numeric',
            'deliverables.*.due_date_months' => 'max:2147483647|nullable|numeric',
        ];
    }
}
