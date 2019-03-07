@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.schedules.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.schedules.fields.date')</th>
                            <td field-key='date'>{{ $schedule->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.schedules.fields.description')</th>
                            <td field-key='description'>{{ $schedule->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.schedules.fields.status')</th>
                            <td field-key='status'>{{ $schedule->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.schedules.fields.project')</th>
                            <td field-key='project'>{{ $schedule->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.schedules.fields.highlight')</th>
                            <td field-key='highlight'>{{ $schedule->highlight }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.schedules.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
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
            
@stop
