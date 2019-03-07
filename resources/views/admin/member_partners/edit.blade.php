@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.member-partners.title')</h3>
    
    {!! Form::model($member_partner, ['method' => 'PUT', 'route' => ['admin.member_partners.update', $member_partner->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('member_id', trans('global.member-partners.fields.member').'', ['class' => 'control-label']) !!}
                    {!! Form::select('member_id', $members, old('member_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('member_id'))
                        <p class="help-block">
                            {{ $errors->first('member_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('partner_id', trans('global.member-partners.fields.partner').'', ['class' => 'control-label']) !!}
                    {!! Form::select('partner_id', $partners, old('partner_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('partner_id'))
                        <p class="help-block">
                            {{ $errors->first('partner_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

