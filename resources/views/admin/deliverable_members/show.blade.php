@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-members.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deliverable-members.fields.member')</th>
                            <td field-key='member'>{{ $deliverable_member->member->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverable-members.fields.deliverable')</th>
                            <td field-key='deliverable'>{{ $deliverable_member->deliverable->label_identification ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.deliverable_members.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


