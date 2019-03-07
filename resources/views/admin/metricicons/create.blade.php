@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.metricicons.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.metricicons.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('metric_id', trans('global.metricicons.fields.metric-id').'', ['class' => 'control-label']) !!}
                    {!! Form::number('metric_id', old('metric_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('metric_id'))
                        <p class="help-block">
                            {{ $errors->first('metric_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('icon_id', trans('global.metricicons.fields.icon-id').'', ['class' => 'control-label']) !!}
                    {!! Form::number('icon_id', old('icon_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('icon_id'))
                        <p class="help-block">
                            {{ $errors->first('icon_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.metricicons.fields.project').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('project_id'))
                        <p class="help-block">
                            {{ $errors->first('project_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

