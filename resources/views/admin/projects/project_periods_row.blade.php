<tr data-index="{{ $index }}">
    <td>{!! Form::text('project_periods['.$index.'][date]', old('project_periods['.$index.'][date]', isset($field) ? $field->date: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('project_periods['.$index.'][period_num]', old('project_periods['.$index.'][period_num]', isset($field) ? $field->period_num: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>