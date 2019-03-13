@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.posts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.posts.fields.created')</th>
                            <td field-key='created'>{{ $post->created }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.posts.fields.user')</th>
                            <td field-key='user'>{{ $post->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.posts.fields.description')</th>
                            <td field-key='description'>{!! $post->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.posts.fields.project')</th>
                            <td field-key='project'>{{ $post->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.posts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
