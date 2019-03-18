@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.team.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.team.fields.member')</th>
                            <td field-key='member'>{{ $team->member->surname ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.team.fields.project')</th>
                            <td field-key='project'>{{ $team->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.team.fields.role')</th>
                            <td field-key='role'>{{ $team->role }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.teams.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


