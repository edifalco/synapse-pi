@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.acronyms.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.acronyms.fields.acronym')</th>
                            <td field-key='acronym'>{{ $acronym->acronym }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.acronyms.fields.partner')</th>
                            <td field-key='partner'>{{ $acronym->partner->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#acronym_projects" aria-controls="acronym_projects" role="tab" data-toggle="tab">Acronym projects</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="acronym_projects">
<table class="table table-bordered table-striped {{ count($acronym_projects) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.acronym-projects.fields.acronyms')</th>
                        <th>@lang('global.acronym-projects.fields.partner')</th>
                        <th>@lang('global.acronym-projects.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($acronym_projects) > 0)
            @foreach ($acronym_projects as $acronym_project)
                <tr data-entry-id="{{ $acronym_project->id }}">
                    <td field-key='acronyms'>{{ $acronym_project->acronyms->acronym ?? '' }}</td>
                                <td field-key='partner'>{{ $acronym_project->partner->name ?? '' }}</td>
                                <td field-key='project'>{{ $acronym_project->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronym_projects.restore', $acronym_project->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronym_projects.perma_del', $acronym_project->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('acronym_project_view')
                                    <a href="{{ route('admin.acronym_projects.show',[$acronym_project->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('acronym_project_edit')
                                    <a href="{{ route('admin.acronym_projects.edit',[$acronym_project->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('acronym_project_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronym_projects.destroy', $acronym_project->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.acronyms.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


