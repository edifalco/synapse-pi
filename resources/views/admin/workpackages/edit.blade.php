@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.workpackages.title')</h3>
    
    {!! Form::model($workpackage, ['method' => 'PUT', 'route' => ['admin.workpackages.update', $workpackage->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('wp_id', trans('global.workpackages.fields.wp-id').'', ['class' => 'control-label']) !!}
                    {!! Form::text('wp_id', old('wp_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('wp_id'))
                        <p class="help-block">
                            {{ $errors->first('wp_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.workpackages.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.workpackages.fields.project').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('order', trans('global.workpackages.fields.order').'', ['class' => 'control-label']) !!}
                    {!! Form::number('order', old('order'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('order'))
                        <p class="help-block">
                            {{ $errors->first('order') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Deliverables
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.deliverables.fields.label-identification')</th>
                        <th>@lang('global.deliverables.fields.confidentiality')</th>
                        <th>@lang('global.deliverables.fields.due-date-months')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="deliverables">
                    @forelse(old('deliverables', []) as $index => $data)
                        @include('admin.workpackages.deliverables_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($workpackage->deliverables as $item)
                            @include('admin.workpackages.deliverables_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="deliverables-template">
        @include('admin.workpackages.deliverables_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
@stop