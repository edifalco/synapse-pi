@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverables.title')</h3>
    
    {!! Form::model($deliverable, ['method' => 'PUT', 'route' => ['admin.deliverables.update', $deliverable->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('label_identification', trans('global.deliverables.fields.label-identification').'', ['class' => 'control-label']) !!}
                    {!! Form::text('label_identification', old('label_identification'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('label_identification'))
                        <p class="help-block">
                            {{ $errors->first('label_identification') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.deliverables.fields.title').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('short_title', trans('global.deliverables.fields.short-title').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('short_title', old('short_title'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('short_title'))
                        <p class="help-block">
                            {{ $errors->first('short_title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', trans('global.deliverables.fields.date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
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
                    {!! Form::label('status_id', trans('global.deliverables.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status_id', $statuses, old('status_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status_id'))
                        <p class="help-block">
                            {{ $errors->first('status_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('notes', trans('global.deliverables.fields.notes').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('project_id', trans('global.deliverables.fields.project').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('confidentiality', trans('global.deliverables.fields.confidentiality').'', ['class' => 'control-label']) !!}
                    {!! Form::number('confidentiality', old('confidentiality'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('confidentiality'))
                        <p class="help-block">
                            {{ $errors->first('confidentiality') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('submission_date', trans('global.deliverables.fields.submission-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('submission_date', old('submission_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('submission_date'))
                        <p class="help-block">
                            {{ $errors->first('submission_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('due_date_months', trans('global.deliverables.fields.due-date-months').'', ['class' => 'control-label']) !!}
                    {!! Form::number('due_date_months', old('due_date_months'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('due_date_months'))
                        <p class="help-block">
                            {{ $errors->first('due_date_months') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('responsible', trans('global.deliverables.fields.responsible').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-responsible">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-responsible">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('responsible[]', $responsibles, old('responsible') ? old('responsible') : $deliverable->responsible->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-responsible' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('responsible'))
                        <p class="help-block">
                            {{ $errors->first('responsible') }}
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
            
        });
    </script>
            
    <script>
        $("#selectbtn-responsible").click(function(){
            $("#selectall-responsible > option").prop("selected","selected");
            $("#selectall-responsible").trigger("change");
        });
        $("#deselectbtn-responsible").click(function(){
            $("#selectall-responsible > option").prop("selected","");
            $("#selectall-responsible").trigger("change");
        });
    </script>
@stop