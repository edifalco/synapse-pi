@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-partners.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.deliverable_partners.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('partner_id', trans('global.deliverable-partners.fields.partner').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('deliverable_id', trans('global.deliverable-partners.fields.deliverable').'', ['class' => 'control-label']) !!}
                    {!! Form::select('deliverable_id', $deliverables, old('deliverable_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('deliverable_id'))
                        <p class="help-block">
                            {{ $errors->first('deliverable_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

