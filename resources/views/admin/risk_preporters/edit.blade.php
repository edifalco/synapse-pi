@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risk-preporters.title')</h3>
    
    {!! Form::model($risk_preporter, ['method' => 'PUT', 'route' => ['admin.risk_preporters.update', $risk_preporter->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('partner_id', trans('global.risk-preporters.fields.partner').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('risk_id', trans('global.risk-preporters.fields.risk').'', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

