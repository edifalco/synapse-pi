<tr data-index="{{ $index }}">
    <td>{!! Form::number('projects['.$index.'][duration]', old('projects['.$index.'][duration]', isset($field) ? $field->duration: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('projects['.$index.'][image]', old('projects['.$index.'][image]', isset($field) ? $field->image: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>