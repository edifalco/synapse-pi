@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.scoredescriptions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.scoredescriptions.fields.description')</th>
                            <td field-key='description'>{!! $scoredescription->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.scoredescriptions.fields.project')</th>
                            <td field-key='project'>{{ $scoredescription->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.scoredescriptions.fields.score-id')</th>
                            <td field-key='score_id'>{{ $scoredescription->score_id }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.scoredescriptions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


