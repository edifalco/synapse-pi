@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-reviewers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deliverable-reviewers.fields.deliverable')</th>
                            <td field-key='deliverable'>{{ $deliverable_reviewer->deliverable->label_identification ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverable-reviewers.fields.member')</th>
                            <td field-key='member'>{{ $deliverable_reviewer->member->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.deliverable_reviewers.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


