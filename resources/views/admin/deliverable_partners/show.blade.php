@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-partners.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deliverable-partners.fields.partner')</th>
                            <td field-key='partner'>{{ $deliverable_partner->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverable-partners.fields.deliverable')</th>
                            <td field-key='deliverable'>{{ $deliverable_partner->deliverable->label_identification ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.deliverable_partners.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


