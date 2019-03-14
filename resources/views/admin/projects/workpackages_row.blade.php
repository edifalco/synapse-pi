<tr data-index="{{ $index }}">
    <td>{!! Form::text('workpackages['.$index.'][wp_id]', old('workpackages['.$index.'][wp_id]', isset($field) ? $field->wp_id: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('workpackages['.$index.'][name]', old('workpackages['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('workpackages['.$index.'][order]', old('workpackages['.$index.'][order]', isset($field) ? $field->order: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>