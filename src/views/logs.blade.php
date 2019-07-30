@extends($layout)

@section('title')
Settings Logs
@stop

@section('main')
    <div class="row">
        {{ Form::open(['method'=>'get']) }}
        <div class="col-md-3">
            {{ Form::text('search', @$input['search'], ['class'=>'form-control', 'placeholder'=>'Search...']) }}
        </div>
        <div class="col-md-2">
            {{ Form::submit('submit', ['class'=>'form-control btn btn-primary', 'placeholder'=>'Search...']) }}
        </div>
        {{ Form::close() }}
    </div>
    <br>
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Author</th>
                <th>Changes</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $logItem)
            <tr>
                <td>{{ $logItem->id }}</td>
                <td>{{ $logItem->user_id }}</td>
                <td>
                    {{ \Ofat\DbConfigAdmin\Utils\Diff::toHTML($logItem->diff) }}
                </td>
                <td>
                    {{ $logItem->created_at }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{ $logs->links() }}
@stop