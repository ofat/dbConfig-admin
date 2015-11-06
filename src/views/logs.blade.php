@extends($layout)

@section('title')
Settings Logs
@stop

@section('main')
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
                    {{ $logItem->old_value }} - <em>{{ $logItem->new_value }}</em>
                    <p class="text-muted">
                        {{ $logItem->old_comment }} - <em>{{ $logItem->new_comment }}</em>
                    </p>
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