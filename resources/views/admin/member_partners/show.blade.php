@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.member-partners.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.member-partners.fields.member')</th>
                            <td field-key='member'>{{ $member_partner->member->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.member-partners.fields.partner')</th>
                            <td field-key='partner'>{{ $member_partner->partner->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.member_partners.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


