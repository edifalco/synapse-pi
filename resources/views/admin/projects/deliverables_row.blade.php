<tr data-index="{{ $index }}">
    <td>{!! Form::text('deliverables['.$index.'][label_identification]', old('deliverables['.$index.'][label_identification]', isset($field) ? $field->label_identification: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('deliverables['.$index.'][confidentiality]', old('deliverables['.$index.'][confidentiality]', isset($field) ? $field->confidentiality: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('deliverables['.$index.'][due_date_months]', old('deliverables['.$index.'][due_date_months]', isset($field) ? $field->due_date_months: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>