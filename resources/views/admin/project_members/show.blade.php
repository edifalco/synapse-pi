@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.project-members.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.project-members.fields.project')</th>
                            <td field-key='project'>{{ $project_member->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.project-members.fields.member')</th>
                            <td field-key='member'>{{ $project_member->member->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.project-members.fields.partner')</th>
                            <td field-key='partner'>{{ $project_member->partner->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.project_members.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


