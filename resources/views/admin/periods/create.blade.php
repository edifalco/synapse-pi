@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.periods.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.periods.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', trans('global.periods.fields.date').'', ['class' => 'control-label']) !!}
                    {!! Form::number('date', old('date'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('period_num', trans('global.periods.fields.period-num').'', ['class' => 'control-label']) !!}
                    {!! Form::number('period_num', old('period_num'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('period_num'))
                        <p class="help-block">
                            {{ $errors->first('period_num') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.periods.fields.project').'', ['class' => 'control-label']) !!}
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

