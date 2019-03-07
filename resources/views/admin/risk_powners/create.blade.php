@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risk-powners.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.risk_powners.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('partner_id', trans('global.risk-powners.fields.partner').'', ['class' => 'control-label']) !!}
                    {!! Form::select('partner_id', $partners, old('partner_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('partner_id'))
                        <p class="help-block">
                            {{ $errors->first('partner_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('risk_id', trans('global.risk-powners.fields.risk').'', ['class' => 'control-label']) !!}
                    {!! Form::select('risk_id', $risks, old('risk_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('risk_id'))
                        <p class="help-block">
                            {{ $errors->first('risk_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

