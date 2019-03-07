@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.acronym-projects.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.acronym-projects.fields.acronym')</th>
                            <td field-key='acronym'>{{ $acronym_project->acronym->acronym ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.acronym-projects.fields.partner')</th>
                            <td field-key='partner'>{{ $acronym_project->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.acronym-projects.fields.project')</th>
                            <td field-key='project'>{{ $acronym_project->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.acronym_projects.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


