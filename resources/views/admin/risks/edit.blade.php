@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risks.title')</h3>
    
    {!! Form::model($risk, ['method' => 'PUT', 'route' => ['admin.risks.update', $risk->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('code', trans('global.risks.fields.code').'', ['class' => 'control-label']) !!}
                    {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('code'))
                        <p class="help-block">
                            {{ $errors->first('code') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('version', trans('global.risks.fields.version').'', ['class' => 'control-label']) !!}
                    {!! Form::number('version', old('version'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('version'))
                        <p class="help-block">
                            {{ $errors->first('version') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('parent_id', trans('global.risks.fields.parent-id').'', ['class' => 'control-label']) !!}
                    {!! Form::number('parent_id', old('parent_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('parent_id'))
                        <p class="help-block">
                            {{ $errors->first('parent_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.risks.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('score', trans('global.risks.fields.score').'', ['class' => 'control-label']) !!}
                    {!! Form::number('score', old('score'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('score'))
                        <p class="help-block">
                            {{ $errors->first('score') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('flag', trans('global.risks.fields.flag').'', ['class' => 'control-label']) !!}
                    {!! Form::text('flag', old('flag'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('flag'))
                        <p class="help-block">
                            {{ $errors->first('flag') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.risks.fields.project').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('project_id'))
                        <p class="help-block">
                            {{ $errors->first('project_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('impact', trans('global.risks.fields.impact').'', ['class' => 'control-label']) !!}
                    {!! Form::number('impact', old('impact'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('impact'))
                        <p class="help-block">
                            {{ $errors->first('impact') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('probability', trans('global.risks.fields.probability').'', ['class' => 'control-label']) !!}
                    {!! Form::number('probability', old('probability'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('probability'))
                        <p class="help-block">
                            {{ $errors->first('probability') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('proximity', trans('global.risks.fields.proximity').'', ['class' => 'control-label']) !!}
                    {!! Form::text('proximity', old('proximity'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('proximity'))
                        <p class="help-block">
                            {{ $errors->first('proximity') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.risks.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('title', old('title'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contingency', trans('global.risks.fields.contingency').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('contingency', old('contingency'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contingency'))
                        <p class="help-block">
                            {{ $errors->first('contingency') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('mitigation', trans('global.risks.fields.mitigation').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('mitigation', old('mitigation'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('mitigation'))
                        <p class="help-block">
                            {{ $errors->first('mitigation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('triggerevents', trans('global.risks.fields.triggerevents').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('triggerevents', old('triggerevents'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('triggerevents'))
                        <p class="help-block">
                            {{ $errors->first('triggerevents') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('resolved', trans('global.risks.fields.resolved').'', ['class' => 'control-label']) !!}
                    {!! Form::number('resolved', old('resolved'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('resolved'))
                        <p class="help-block">
                            {{ $errors->first('resolved') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('risk_date', trans('global.risks.fields.risk-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('risk_date', old('risk_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('risk_date'))
                        <p class="help-block">
                            {{ $errors->first('risk_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('version_date', trans('global.risks.fields.version-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('version_date', old('version_date'), ['class' => 'form-control timepicker', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('version_date'))
                        <p class="help-block">
                            {{ $errors->first('version_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('type', trans('global.risks.fields.type').'', ['class' => 'control-label']) !!}
                    {!! Form::number('type', old('type'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('notes', trans('global.risks.fields.notes').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('notes', old('notes'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('notes'))
                        <p class="help-block">
                            {{ $errors->first('notes') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
            $('.timepicker').datetimepicker({
                format: "{{ config('app.time_format_moment') }}",
            });
            
        });
    </script>
            
@stop