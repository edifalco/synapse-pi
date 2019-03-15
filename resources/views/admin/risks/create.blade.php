@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risks.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.risks.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
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
                    {!! Form::label('flag', trans('global.risks.fields.flag').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('flag', 0) !!}
                    {!! Form::checkbox('flag', 1, old('flag', false), []) !!}
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
                    {!! Form::label('resolved', trans('global.risks.fields.resolved').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('resolved', 0) !!}
                    {!! Form::checkbox('resolved', 1, old('resolved', false), []) !!}
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
                    {!! Form::label('risks_type_id', trans('global.risks.fields.risks-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('risks_type_id', $risks_types, old('risks_type_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('risks_type_id'))
                        <p class="help-block">
                            {{ $errors->first('risks_type_id') }}
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
                    {!! Form::label('trigger_events', trans('global.risks.fields.trigger-events').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('trigger_events', old('trigger_events'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('trigger_events'))
                        <p class="help-block">
                            {{ $errors->first('trigger_events') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('risk_impact_id', trans('global.risks.fields.risk-impact').'', ['class' => 'control-label']) !!}
                    {!! Form::select('risk_impact_id', $risk_impacts, old('risk_impact_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('risk_impact_id'))
                        <p class="help-block">
                            {{ $errors->first('risk_impact_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('risk_probabilities_id', trans('global.risks.fields.risk-probabilities').'', ['class' => 'control-label']) !!}
                    {!! Form::select('risk_probabilities_id', $risk_probabilities, old('risk_probabilities_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('risk_probabilities_id'))
                        <p class="help-block">
                            {{ $errors->first('risk_probabilities_id') }}
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
                    {!! Form::label('risk_proximity_id', trans('global.risks.fields.risk-proximity').'', ['class' => 'control-label']) !!}
                    {!! Form::select('risk_proximity_id', $risk_proximities, old('risk_proximity_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('risk_proximity_id'))
                        <p class="help-block">
                            {{ $errors->first('risk_proximity_id') }}
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
                    {!! Form::label('risk_owner', trans('global.risks.fields.risk-owner').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-risk_owner">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-risk_owner">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('risk_owner[]', $risk_owners, old('risk_owner'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-risk_owner' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('risk_owner'))
                        <p class="help-block">
                            {{ $errors->first('risk_owner') }}
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
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
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
            
    <script>
        $("#selectbtn-risk_owner").click(function(){
            $("#selectall-risk_owner > option").prop("selected","selected");
            $("#selectall-risk_owner").trigger("change");
        });
        $("#deselectbtn-risk_owner").click(function(){
            $("#selectall-risk_owner > option").prop("selected","");
            $("#selectall-risk_owner").trigger("change");
        });
    </script>
@stop